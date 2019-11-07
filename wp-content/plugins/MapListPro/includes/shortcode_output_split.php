<?php

//Get all options
extract($options);
$measurementUnits = (get_option('maplist_measurmentunits') == 'METRIC' ? 'Km' : 'Miles');
$categorylabel = (get_option('maplist_category_name') == '' ? __('Categories','maplistpro') : get_option('maplist_category_name'));

//html variable to return to page
$mlpoutputhtml = '';
$numberOfLocations = $this->numberOfLocations;
$countertemp = self::$counter;

//All of the parts to display
$templateParts = $this->get_main_map_display_parts();

//WRAPPER
//====================================================
$mlpoutputhtml .= "<div class='prettyMapList $mapposition cf' id='MapListPro$countertemp'>";

    if($numberOfLocations == 0){
        $mlpoutputhtml .= "<p class='prettyMessage'>" . __('No locations found.','maplistpro') . "</p>";
    }
    else{

    foreach($templateParts as $part){

        switch($part){
            case "map":
                //MAP
                //====================================================
                if($viewstyle == 'both' || $viewstyle == 'maponly' || $viewstyle == 'accordion'){

                    $mlpoutputhtml .= "<!--The Map -->";
                    $mlpoutputhtml .= "<div id='map-canvas$countertemp' class='mapHolder'></div>";

                    $mlpoutputhtml .= "<!-- hidden div that gets bound -->";
                    $mlpoutputhtml .= '<div data-bind="map: $data.filteredLocations()"></div>';
                }
                break;
            case "message":
                $mlpoutputhtml .= "<!--Message bar-->";
                $mlpoutputhtml .= "<div class='prettyMessage' data-bind='visible: anyLocationsAvailable' style='display:none;'><span>" . __('No matching locations','maplistpro') . " </span><a class='btn' href='#' data-bind='click:clearSearch'>" . __('Show all locations','maplistpro'). "</a></div>";
                $mlpoutputhtml .= "<div class='prettyMessage' data-bind='visible: geocodeFail' style='display:none;'><span>" . __('No location found','maplistpro') . " </span><a class='btn' href='#' data-bind='click:clearSearch'>" . __('Show all locations','maplistpro'). "</a></div>";
                break;
            case "search":
                if($hidefilterbar != 'true'){

                    $mlpoutputhtml .= "<!-- Search, Filters, Sorting bar -->";
                    $mlpoutputhtml .= "<div class='prettyFileBar clearfix'>";

                    //Don't put the category button here if using custom categories
                    if(!$usealltaxonomies == true){
                        if($hidefilter != 'true'){
                            if($categoriesaslist == "false"){
                                $mlpoutputhtml .= "<!-- Category button -->";
                                $mlpoutputhtml .= '<div class="customCategoryList">';
                                    $mlpoutputhtml .= "<a class='showFilterBtn float_right corePrettyStyle btn' href='#' data-bind='click:showCategories'>" . $categorylabel . "</a>";

                                    $mlpoutputhtml .= "<ul class='unstyled menuDropDown' data-bind='foreach: {data: mapCategories}'>";
                                        $mlpoutputhtml .= "<li data-bind='css:slug'>";
                                            $mlpoutputhtml .= "<a data-bind='css: {" . 'showing' . ": selected}, html: " . '$data.title, click: $parent.selectCategory' . "' href='#'></a>";
                                        $mlpoutputhtml .= "</li>";
                                    $mlpoutputhtml .= "</ul>";

                                $mlpoutputhtml .= "</div>";
                            }
                        }
                    }

                    //SORTING
                    //===================================================
                    $mlpoutputhtml .= "<!-- Sorting button -->";

                    if($hidesort != 'true' && $viewstyle != 'maponly'){
                        if($geoenabled == 'true' || $simplesearch != 'true'){
                            $mlpoutputhtml .= "<div class='customCategoryList sortList'>";
                                $mlpoutputhtml .= "<a data-bind='click:showCategories' class='showSortingBtn float_right corePrettyStyle btn' href='#'>" . __('Sort','maplistpro'). "</a>";

                                $mlpoutputhtml .= "<ul class='unstyled menuDropDown'>";
                                    $mlpoutputhtml .= "<li><a href='#' data-sorttype='title' data-bind='" . 'click:$root.sortList' . "'>" . __('Title','maplistpro'). "</a></li>";
                                    $mlpoutputhtml .= "<li><a href='#' data-sorttype='distance' data-bind='" . 'click:$root.sortList' . "'>" . __('Distance','maplistpro'). "</a></li>";
                                $mlpoutputhtml .= "</ul>";
                            $mlpoutputhtml .= "</div>";
                        }
                        else{
                            $mlpoutputhtml .= "<a data-sorttype='title' class='showSortingBtn float_right corePrettyStyle sortAsc btn' href='#' data-bind='click:sortList'>" . __('Sort','maplistpro'). "</a>";
                        }
                    }

                    //SEARCH
                    //===================================================
                    if($hidesearch != 'true'){

                        $mlpoutputhtml .= "<form id='Map-List-Search' data-bind='submit:mapSearchSubmit' class='prettyMapListSearch $simplesearch'>";

                            if($simplesearch == 'true'){
                                //TEXT SEARCH
                                $mlpoutputhtml .= "<label>" . __('Search locations','maplistpro'). "</label>";
                                $mlpoutputhtml .= "<input type='text' class='prettySearchValue' data-bind='value: query, valueUpdate:" . '"keyup"' . "' autocomplete='off' value='" . __('Search','maplistpro') ."'>";
                            }
                            else{
                                if($simplesearch == 'combo'){
                                    //COMBO SEARCH
                                    $mlpoutputhtml .= "<input type='text' class='prettySearchValue' autocomplete='off' placeholder=" . __('Search…','maplistpro') ." value=''>";
                                    $mlpoutputhtml .= "<select class='distanceSelector' name='distanceSelector' id='distanceSelector' data-bind='options: distanceFilters, optionsText:function(item){return item.label}, optionsValue: function(item){return item.value}, value: chosenFromDistance'></select>";
                                    $mlpoutputhtml .= "<input type='text' class='prettySearchLocationValue' autocomplete='off' placeholder=". __('Location…','maplistpro')." value=''>";

                                    $mlpoutputhtml .= "<a class='doPrettySearch btn corePrettyStyle' data-bind='click:comboSearch'>" . __('Go','maplistpro'). "</a>";
                                }
                                else{
                                    //LOCATION SEARCH
                                    //TODO:Add default value in
                                    $mlpoutputhtml .= "<label class='hidden'>" . __('Find locations near','maplistpro'). "</label>";
                                    $mlpoutputhtml .= "<input type='text' class='prettySearchValue' autocomplete='off' placeholder=" . __('Search…','maplistpro') ." value=''>";
                                    $mlpoutputhtml .= "<select class='distanceSelector' name='distanceSelector' id='distanceSelector' data-bind='options: distanceFilters, optionsText:function(item){return item.label}, optionsValue: function(item){return item.value}, value: chosenFromDistance'></select>";
                                    $mlpoutputhtml .= "<a class='doPrettySearch btn corePrettyStyle' data-bind='click:locationSearch'>" . __('Go','maplistpro'). "</a>";
                                }

                            }

                            $mlpoutputhtml .= "<a class='clearSearch btn corePrettyStyle' data-bind='visible: anySearchTermsEntered, click: clearSearch'>" . __('Clear','maplistpro'). "</a>";
                        $mlpoutputhtml .= "</form>";//EOF .prettyMapListSearch
                    }

                    //CATEGORIES
                    //===================================================
                   if($categoriesaslist == "true" && $hidefilter != 'true'){
                        $mlpoutputhtml .= "<div class='categoryList clearfix'>";
                            $mlpoutputhtml .= "<ul class='unstyled menuDropDown' data-bind='foreach: {data: mapCategories}'>";
                                $mlpoutputhtml .= "<li data-bind='css:slug'>";
                                    $mlpoutputhtml .= "<a data-bind='css: cssClass, html: " . '$data.title, click: $parent.selectCategory' . "' href='#'></a>";
                                $mlpoutputhtml .= "</li>";
                            $mlpoutputhtml .= "</ul>";
                        $mlpoutputhtml .= "</div>";
                    }

                    //All categories
                    if($usealltaxonomies == true && Count($allTaxObjects) > 0){
                        $mlpoutputhtml .= "<div class='multiCategoryFilter'>";
                        /*Core categories*/
                        if($hidefilter != 'true'){
                            if($categoriesaslist == "false"){
                                $mlpoutputhtml .= '<div class="customCategoryList">';
                                    $mlpoutputhtml .= "<a class='showFilterBtn float_right corePrettyStyle btn' href='#' data-bind='click:showCategories'>" . $categorylabel. "</a>";

                                    $mlpoutputhtml .= "<ul class='unstyled menuDropDown' data-bind='foreach: {data: mapCategories}'>";
                                        $mlpoutputhtml .= "<li data-bind='css:slug'>";
                                            $mlpoutputhtml .= "<a data-bind='css: {" . '"showing"' . ": selected}, text: " . '$data.title, click: $parent.selectCategory' . "' href='#'></a>";
                                        $mlpoutputhtml .= "</li>";
                                    $mlpoutputhtml .= "</ul>";

                                $mlpoutputhtml .= "</div>";
                            }
                        }

                        foreach($allTaxObjects as $key => $taxObject){
                            //Dont create a list for the lookup
                            if($key == 'taxonomyLookup'){continue;}

                            //Needed to get the taxonomy name
                            $fullTax = get_taxonomy( $key );

                           if($categoriesaslist == "true"){
                                $mlpoutputhtml .= "<div class='categoryList clearfix'>";
                                    $mlpoutputhtml .= "<ul class='unstyled menuDropDown' data-bind='foreach: {data: customCategories." . $key ."}'>";
                                        $mlpoutputhtml .= "<li data-bind='css:slug'>";
                                            $mlpoutputhtml .= "<a data-bind='css: cssClass, html: " . '$data.title, click: $parent.selectCategory' . "' href='#'></a>";
                                        $mlpoutputhtml .= "</li>";
                                    $mlpoutputhtml .= "</ul>";
                                $mlpoutputhtml .= "</div>";
                            }
                            else{
                                $mlpoutputhtml .= "<div class='customCategoryList'>";
                                    $mlpoutputhtml .= "<a class='customCatButton corePrettyStyle btn' href='' data-bind='click:showCustomCategoriesClick'>" . $fullTax->label . "</a>";
                                    $mlpoutputhtml .= "<ul class='unstyled menuDropDown' data-bind='foreach: {data: customCategories." . $key ."}'>";
                                        $mlpoutputhtml .= "<li data-bind='css:slug'>";
                                            $mlpoutputhtml .= "<a data-taxonomyname='" . $key . "' data-bind='css: {" . '"showing"' . ": selected},text: " . '$data.title, click: $parent.selectCustomCategory' . "' href='#'></a>";
                                        $mlpoutputhtml .= "</li>";
                                    $mlpoutputhtml .= "</ul>";
                                $mlpoutputhtml .= "</div>";
                            }

                        }
                        $mlpoutputhtml .= "</div>";
                    }

                    /*Reset all button*/
                    //TODO:Add an option for this
                    // $mlpoutputhtml .= "<a href='#' class='corePrettyStyle btn' data-bind='click: " . '$root.resetAll' . "'>Reset all</a>";

                    $mlpoutputhtml .= "</div>";//EOF .prettyFileBar
                }
                break;
            case "list":

                $mlpoutputhtml .= "<div id='ListContainer'>";

                    if($viewstyle == 'accordion'){
                        //Custom by category view
                        $mlpoutputhtml .= "<div class='location-accordion' data-bind='foreach: {data: mapCategories}'>";
                            $mlpoutputhtml .= "<h2 class='show-locations' data-bind='text:title, click: " . '$parent.selectCategory' . "'></h2>";
                            $mlpoutputhtml .= "<ul class='location-list' data-bind='slideIn:selected,slideOut:selected,foreach: {data: " . '$root.getLocationsByCategory' . "(" . ' $data.slug' . ")}'>";
                                $mlpoutputhtml .= "<li data-bind='css: {" . '"active"' . ": expanded},text:title,click: " . '$root.locationClick' . "'></li>";
                            $mlpoutputhtml .= "</ul>";
                        $mlpoutputhtml .= "</div>";
                    }

                    if($viewstyle == 'both' || $viewstyle == 'listonly'){

                        $mlpoutputhtml .= "<!--The List -->";

                        if($hideuntilsearch === 'true'){
                            $mlpoutputhtml .= "<ul class='unstyled prettyListItems loading' data-bind='visible: anySearchTermsEntered,foreach: {data: pagedLocations}'>";
                        }
                        else{
                            $mlpoutputhtml .= "<ul class='unstyled prettyListItems loading' data-bind='foreach: {data: pagedLocations}'>";
                        }

                        $mlpoutputhtml .= "<li class='corePrettyStyle prettylink map location' data-bind='css: " . '$data.cssClass' . ",click: " . '$root.locationClick' . "'>";
                            $mlpoutputhtml .= "<a href='#' class='viewLocationDetail clearfix'>";

                                $mlpoutputhtml .= "<!-- ko if: " . '$data.smallImageUrl' . " -->";
                                    $mlpoutputhtml .= "<img src='#' data-bind='attr:{src: " . '$data.smallImageUrl' . "}' class='smallImage' />";
                                $mlpoutputhtml .= "<!-- /ko -->";
                                $mlpoutputhtml .= "<span data-bind='html:" . '$data.title' . "'></span>";
                                $mlpoutputhtml .= "<span data-bind='text:" . '$data.friendlyDistance' . "'></span>";

                                if($hidecategoriesonitems != "true"){
                                    $mlpoutputhtml .= "<span class='mapcategories'><span class='categoryLabel'>" . $categorylabel . ":</span>";
                                        $mlpoutputhtml .= " <span data-bind='html:" . '$parent.itemCategories($data)' . "'></span>";
                                    $mlpoutputhtml .= "</span>";

                                }


                                $mlpoutputhtml .= "</a>";
                                $mlpoutputhtml .= "<!--Expanded item-->";
                                $mlpoutputhtml .= "<div class='mapLocationDetail clearfix' style='display:none;' data-bind='slideIn: " . '$data.expanded' . ",slideOut: " . '$data.expanded' . "'>";
                                    $mlpoutputhtml .= "<div class='mapDescription clearfix'>";
                                        $mlpoutputhtml .= "<!-- ko if: " . '$data.imageUrl' . " -->";
                                            // $mlpoutputhtml .= "<a href='#' data-bind='attr:{href:" . '$data.locationUrl' . "}'" . ($openinnew == false ? "" : "target='_blank'") . ">";
                                                $mlpoutputhtml .= "<img src='#' data-bind='attr:{src: " . '$data.imageUrl' . "}' class='featuredImage float_left' />";
                                            // $mlpoutputhtml .= "</a>";
                                        $mlpoutputhtml .= "<!-- /ko -->";
                                        $mlpoutputhtml .= "<div class='description float_left'>";
                                            $mlpoutputhtml .= "<div data-bind='{html:" . '$data.description' . "}'></div>";
                                        $mlpoutputhtml .= "</div>";
                                    $mlpoutputhtml .= "</div>";

                                    if($hideviewdetailbuttons != "true"){
                                        $mlpoutputhtml .= "<!-- ko if: " . '$data.locationUrl' . "-->";
                                            $mlpoutputhtml .= "<a href='#' class='viewLocationPage btn corePrettyStyle' data-bind='attr:{href:" . '$data.locationUrl' . "}'" . ($openinnew == false ? "" : "target='_blank'") . ">" . __('View location detail','maplistpro'). "</a>";
                                        $mlpoutputhtml .= "<!-- /ko -->";
                                    }

                                    if($showdirections == 'true'){
                                        $mlpoutputhtml .= "<!-- Directions -->";
                                        $mlpoutputhtml .= "<div class='getDirections'>" . __('Get directions from','maplistpro');
                                            $mlpoutputhtml .= '<form data-bind="submit: $root.getDirectionsClick">';

                                            $mlpoutputhtml .= " <input class='directionsPostcode' type='text' value='' size='10'/>";
                                            $mlpoutputhtml .= "<a href='#' class='getdirections btn corePrettyStyle' data-bind='click:" . '$root.getDirectionsClick' . "'>" . __('Go','maplistpro'). "</a>";
                                            $mlpoutputhtml .= "<a href='#' class='getdirectionsgeo btn corePrettyStyle' data-bind='click:" . '$root.getDirectionsClick' . "'>" . __('Geo locate me','maplistpro'). "</a>";
                                            $mlpoutputhtml .= "<div class='mapLocationDirectionsHolder'></div>";
                                            $mlpoutputhtml .= "</form>";
                                        $mlpoutputhtml .= "</div>";
                                    }
                                $mlpoutputhtml .= "</div>";
                        $mlpoutputhtml .= "</li>";
                        $mlpoutputhtml .= "</ul>";



                    }

                    $mlpoutputhtml .= "</div>";//ListContainer
                break;
            case "paging":
                //If less than a page of results
                if($numberOfLocations > $locationsperpage && $viewstyle !== 'maponly'){
                    if($hideuntilsearch === 'true'){
                        $mlpoutputhtml .= "<div class='prettyPagination' data-bind='visible: anySearchTermsEntered'>";
                    }
                    else{
                        $mlpoutputhtml .= "<div class='prettyPagination'>";
                    }

                        $mlpoutputhtml .= "<a class='pfl_next btn corePrettyStyle' href='#' data-bind='click: nextPage,css:nextPageButtonCSS'>" . __('Next','maplistpro'). " &raquo;</a>";
                        $mlpoutputhtml .= '<div data-bind="visible: pagingVisible" class="pagingInfo">';
                            $mlpoutputhtml .= __('Page','maplistpro'). " <span class='currentPage' data-bind='text: currentPageNumber'></span> " . __('of','maplistpro') . " <span data-bind='text: totalPages' class='totalPages'></span>";
                        $mlpoutputhtml .= "</div>";
                        $mlpoutputhtml .= "<a class='pfl_prev btn corePrettyStyle' data-bind='click: prevPage,css:prevPageButtonCSS' href='#'>&laquo; " . __('Prev','maplistpro'). "</a>";
                    $mlpoutputhtml .= "</div>";
                }
                break;
        }
    }
}



$mlpoutputhtml .= "</div>"; //prettyMapList

$this->mlpoutputhtml = $mlpoutputhtml;
self::$counter++;
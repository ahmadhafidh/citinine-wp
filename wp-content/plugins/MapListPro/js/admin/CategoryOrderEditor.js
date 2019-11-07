(function($) {

    $(document).ready(function(){

        var pluginUrl = maplistScriptParams.pluginUrl;

        var iconPicker = $('#IconPicker');
        var iconItems = $('> li',iconPicker);
        var markerChoices = $('#AllIconChoices');

        //Sort icons by position
        iconPicker.append(iconItems.sort(asc_byposition));

        //Sort the items into their correct order on load
        ////==============================================
        //Set the position and activeiconid data attribute for each item
        iconItems.each(function(){
            var thisItem = $(this);
            var data = ($('input',thisItem).val()).split(",");

            //If no icon or position is set
            //TODO:Pull default icon from settings
            if(data.length == 1){
                data = [30,'default/mapmarker1.png','default/shadow.png'];
            }
        });

        //Make the list sortable
        iconPicker.sortable({
             items: "> li",
             helper : 'clone',
             axis:'y',
             cancel : 'input,.iconChooser,.mapCategoryIcons',
             stop: function(event,ui){

                //Re-get iconitems so it's in correct order
                iconItems = $('> li',iconPicker);

                //Set the sort levels on all fields
                iconItems.each(function(index){
                    //Split current val to array
                    var itemDetail = $('input',$(this)).val().split(",");
                    //Set new position
                    itemDetail[0] = index + 1;
                    //Set the field value
                     $('input',$(this)).val(itemDetail.join());
                });
            }
        });

        //Expand the items on click
        $('.categoryItem',iconPicker).click(function(e){

            var self = $(this);

            var picker = $('.iconChooser',self);

            //Hide all others
            $('.iconChooser').not(picker).hide();

            //Clone in the icons when we show the picker
            if(picker.is(':hidden')){
                $('.mapCategoryIcons', picker).append( markerChoices.show() );
            }

            //Show/hide the icon chooser
            $('.iconChooser',self).toggle(200);

            e.preventDefault();
        });

        $(iconPicker).on("click",".mapIcon",function(){

            var clicked = $(this);
            var iconChooser = $(this).parents('.iconChooser');
            var iconChooserParent = iconChooser.parent();
            var shadowIcon = 'none';

            //Set the val with position, img, shadow
            iconChooser.prev('input').val(iconChooserParent.data('position') + ',' + clicked.data('iconfolder') + '/' +  clicked.data('iconimage') + ',' + shadowIcon);

            var newVal = iconChooserParent.data('position')+ ',' + clicked.data('iconfolder') + '/' +  clicked.data('iconimage') + ',' + shadowIcon;

            iconChooser.prev('input').val(newVal);

            //Update the current active icon
            $('.currentIcon',iconChooserParent).css('background-image' , 'url(' + pluginUrl + '/images/pins/' + clicked.data('iconfolder') + '/' +  clicked.data('iconimage') + ')');

            return false;
        });

    });

    function asc_byposition(a, b){
        return ($(b).data('position') < $(a).data('position') ? 1 : -1);
    }

})( jQuery );



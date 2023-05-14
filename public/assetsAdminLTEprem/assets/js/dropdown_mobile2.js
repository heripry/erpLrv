$.mobile.document
    // "filter-menu-menu" is the ID generated for the listview when it is created
    // by the custom selectmenu plugin. Upon creation of the listview widget we
    // want to prepend an input field to the list to be used for a filter.
    .on( "listviewcreate", "#filter-menu-menu", function( e ) {
        var input,
            listbox = $( "#filter-menu-listbox" ),
            form = listbox.jqmData( "filter-form" ),
            listview = $( e.target );
        // We store the generated form in a variable attached to the popup so we
        // avoid creating a second form/input field when the listview is
        // destroyed/rebuilt during a refresh.
        if ( !form ) {
            input = $( "<input data-type='search'></input>" );
            form = $( "<form></form>" ).append( input );
            input.textinput();
            $( "#filter-menu-listbox" )
                .prepend( form )
                .jqmData( "filter-form", form );
        }
        // Instantiate a filterable widget on the newly created listview and
        // indicate that the generated input is to be used for the filtering.
        listview.filterable({ input: input });
    })
    // The custom select list may show up as either a popup or a dialog,
    // depending how much vertical room there is on the screen. If it shows up
    // as a dialog, then the form containing the filter input field must be
    // transferred to the dialog so that the user can continue to use it for
    // filtering list items.
    //
    // After the dialog is closed, the form containing the filter input is
    // transferred back into the popup.
    .on( "pagebeforeshow pagehide", "#filter-menu-dialog", function( e ) {
        var form = $( "#filter-menu-listbox" ).jqmData( "filter-form" ),
            placeInDialog = ( e.type === "pagebeforeshow" ),
            destination = placeInDialog ? $( e.target ).find( ".ui-content" ) : $( "#filter-menu-listbox" );
        form
            .find( "input" )
            // Turn off the "inset" option when the filter input is inside a dialog
            // and turn it back on when it is placed back inside the popup, because
            // it looks better that way.
            .textinput( "option", "inset", !placeInDialog )
            .end()
            .prependTo( destination );
    });


/***********************************************************************************************************************************/
$.mobile.document
    // "txtCustomerID-menu" is the ID generated for the listview when it is created
    // by the custom selectmenu plugin. Upon creation of the listview widget we
    // want to prepend an input field to the list to be used for a filter.
    .on( "listviewcreate", "#txtCustomerID-menu", function( e ) {
        var input,
            listbox = $( "#txtCustomerID-listbox" ),
            form = listbox.jqmData( "filter-form" ),
            listview = $( e.target );
        // We store the generated form in a variable attached to the popup so we
        // avoid creating a second form/input field when the listview is
        // destroyed/rebuilt during a refresh.
        if ( !form ) {
            input = $( "<input data-type='search'></input>" );
            form = $( "<form></form>" ).append( input );
            input.textinput();
            $( "#txtCustomerID-listbox" )
                .prepend( form )
                .jqmData( "filter-form", form );
        }
        // Instantiate a filterable widget on the newly created listview and
        // indicate that the generated input is to be used for the filtering.
        listview.filterable({ input: input });
    })
    // The custom select list may show up as either a popup or a dialog,
    // depending how much vertical room there is on the screen. If it shows up
    // as a dialog, then the form containing the filter input field must be
    // transferred to the dialog so that the user can continue to use it for
    // filtering list items.
    //
    // After the dialog is closed, the form containing the filter input is
    // transferred back into the popup.
    .on( "pagebeforeshow pagehide", "#txtCustomerID-dialog", function( e ) {
        var form = $( "#txtCustomerID-listbox" ).jqmData( "filter-form" ),
            placeInDialog = ( e.type === "pagebeforeshow" ),
            destination = placeInDialog ? $( e.target ).find( ".ui-content" ) : $( "#txtCustomerID-listbox" );
        form
            .find( "input" )
            // Turn off the "inset" option when the filter input is inside a dialog
            // and turn it back on when it is placed back inside the popup, because
            // it looks better that way.
            .textinput( "option", "inset", !placeInDialog )
            .end()
            .prependTo( destination );
    });

$.mobile.document
    // "txtItemID-menu" is the ID generated for the listview when it is created
    // by the custom selectmenu plugin. Upon creation of the listview widget we
    // want to prepend an input field to the list to be used for a filter.
    .on( "listviewcreate", "#txtItemID-menu", function( e ) {
        var input,
            listbox = $( "#txtItemID-listbox" ),
            form = listbox.jqmData( "filter-form" ),
            listview = $( e.target );
        // We store the generated form in a variable attached to the popup so we
        // avoid creating a second form/input field when the listview is
        // destroyed/rebuilt during a refresh.
        if ( !form ) {
            input = $( "<input data-type='search'></input>" );
            form = $( "<form></form>" ).append( input );
            input.textinput();
            $( "#txtItemID-listbox" )
                .prepend( form )
                .jqmData( "filter-form", form );
        }
        // Instantiate a filterable widget on the newly created listview and
        // indicate that the generated input is to be used for the filtering.
        listview.filterable({ input: input });
    })
    // The custom select list may show up as either a popup or a dialog,
    // depending how much vertical room there is on the screen. If it shows up
    // as a dialog, then the form containing the filter input field must be
    // transferred to the dialog so that the user can continue to use it for
    // filtering list items.
    //
    // After the dialog is closed, the form containing the filter input is
    // transferred back into the popup.
    .on( "pagebeforeshow pagehide", "#txtItemID-dialog", function( e ) {
        var form = $( "#txtItemID-listbox" ).jqmData( "filter-form" ),
            placeInDialog = ( e.type === "pagebeforeshow" ),
            destination = placeInDialog ? $( e.target ).find( ".ui-content" ) : $( "#txtItemID-listbox" );
        form
            .find( "input" )
            // Turn off the "inset" option when the filter input is inside a dialog
            // and turn it back on when it is placed back inside the popup, because
            // it looks better that way.
            .textinput( "option", "inset", !placeInDialog )
            .end()
            .prependTo( destination );
    });
/***********************************************************************************************************************************/

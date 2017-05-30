/**
 * Stable Ascyn jQuery Plugin
 * 
 * @author Enmanuel Bisono Payamps <enmanuel0894@gmail.com>
 * @version 2.0
 * @copyright (c) 2016 ITNSoft
 */
(function( $ ){

// Properties and methods private of the plugin
var 
    
    /**
     * Instances of the plugin
     * 
     * @type $.stable
     */
    instance = {},
    
    /**
     * Default Settings for stable
     * 
     * @type {Object}
     */
    defaultSettings = {
        
        // Number of records to show by page
        row: 10,
        
        // Number of pages button to show
        pages: 10,
        
        // Fields to hide 
        exclude: [],
        
        // Attributes for the options buttons
        attributes: [],
        
        // If is TRUE, show the search filter
        search: true,
        
        // If is TRUE, show the select for user will can to change the records
        // per page
        recordPerPage: true,
        
        // Actions buttons 
        options: {},
        
        // Order ASC or DESC
        orderBy: true,
        
        // Storage in sessionStorage the last state of stable
        storage: true
    },
    
    /**
     * Change the page X
     * 
     * @param {Object} event
     * @param {Number} data
     * 
     * @return {Null}
     */
    eventPagination = function( event, data ){
        event.preventDefault();
        
        if( instance[event.data.id].isBusy() ){
            return false;
        }
        
        var page = $( this ).text();  
        instance[event.data.id].changePage( 0, parseInt( page ), data );
    },
    
    /**
     * Change to next page
     * 
     * @param {Object} event
     * 
     * @return {Null}
     */
    nextPage = function( event ){
        event.preventDefault(); 
        
        if( instance[event.data.id].isBusy() ){
            return false;
        }
        
        instance[event.data.id].changePage( 1 );
    },
    
    /**
     * Change to previews page
     * 
     * @param {Object} event
     * 
     * @return {Null}
     */
    previewsPage = function( event ){
        event.preventDefault();
        
        if( instance[event.data.id].isBusy() ){
            return false;
        }
        
        instance[event.data.id].changePage( 2 );
    },
    
    /**
     * Change to next sub-pages
     * 
     * @param {Object} event
     * 
     * @return {Null}
     */
    morePage = function( event ){
        event.preventDefault();
        
        if( instance[event.data.id].isBusy() ){
            return false;
        }
        
        instance[event.data.id].moreAndLessPage( 1 );
    },
    
    /**
     * Change to previews sub-pages
     * 
     * @param {Object} event
     * 
     * @return {Null}
     */
    lessPage = function( event ){
        event.preventDefault();
        
        if( instance[event.data.id].isBusy() ){
            return false;
        }
        
        instance[event.data.id].moreAndLessPage( 2 );
    },
    
    /**
     * Change to start page
     * 
     * @param {Object} event
     * 
     * @return {Null}
     */
    startPage = function( event ){
        event.preventDefault();
        
        if( instance[event.data.id].isBusy() ){
            return false;
        }
        
        instance[event.data.id].moreAndLessPage( 4 );
    },
    
    /**
     * Change to end page
     * 
     * @param {Object} event
     * 
     * @return {Null}
     */
    endPage = function( event ){
        event.preventDefault();
        
        if( instance[event.data.id].isBusy() ){
            return false;
        }
        
        instance[event.data.id].moreAndLessPage( 3, 1 );
    },
    
    /**
     * Change the quantity record by page
     * 
     * @param {Object} event
     * 
     * @return {Null}
     */
    recordPerPage = function( event ){
        
        if( instance[event.data.id].isBusy() ){
            return false;
        }
        
        instance[event.data.id].setRecordPage( $(this).val() );
    },
    
    /**
     * Filter the records by a criterion
     * 
     * @param {Object} event
     * 
     * @return {Null}
     */
    searchFilter = function( event ){
        
        if( instance[event.data.id].isBusy() ){
            return false;
        }
        
        var key = event.which;
        if(  key === 13 || $( this ).val() === "" ){
            instance[event.data.id].searchByCriterion();
        }
    },
    
    /**
     * Filter the records by a criterion
     * 
     * @param {Object} event
     * 
     * @return {Null}
     */
    buttonSearch = function( event ){
        
        if( instance[event.data.id].isBusy() ){
            return false;
        }
        
        instance[event.data.id].searchByCriterion();
    },
    
    /**
     * Change the field to search on criterion
     * 
     * @param {Object} event
     * 
     * @return {Null}
     */
    changeFieldFilter = function( event ){
        
        if( instance[event.data.id].isBusy() ){
            return false;
        }
        
        instance[event.data.id].searchByCriterion();
    },
    
    /**
     * Sorts records based on a field
     * 
     * @param {Object} event
     * 
     * @return {Null}
     */
    orderByData = function( event ){
        event.preventDefault();
        
        if( instance[event.data.id].isBusy() ){
            return false;
        }
        
        instance[event.data.id].setOrderBy( $( this ).attr( 'href' ) );
    };
    
    /**
     * Contruct
     * 
     * @param {type} element
     * @param {type} settings
     */
    $.stable = function( element, settings ){
        this.element         = element;
        this.settings        = settings;
        this.data            = null;
        this.combo_row       = settings.row;
        this.totalrow_cached = 0;
        this.actual_page     = 1;
        this.actual_sub_page = 0;
        this.total_pages     = 0;
        this.total_sub_page  = 0;
        this.orderby         = { ascDesc: false, field: null, type: null };
        this.busy            = false;
    };
    
    /**
     * Check if the stable is busy
     * 
     * @return {Boolean}
     */
    $.stable.prototype.isBusy = function(){
        return this.busy;
    };
    
    /**
     * Check if there are options
     * 
     * @return {Boolean}
     */
    $.stable.prototype.thereAreOptions = function(){
        return !$.isEmptyObject( this.settings.options );
    };
    
    /**
     * Check if there are attributes
     * 
     * @return {Boolean}
     */
    $.stable.prototype.thereAreAttributes = function(){
        return this.settings.attributes.length > 0 ? true: false;
    };
    
    /**
     * Check if there are fields for exclude
     * 
     * @return {Boolean}
     */
    $.stable.prototype.thereAreExcludes = function(){
        return this.settings.exclude.length > 0 ? true: false;
    };
    
    /**
     * Return the fields captured
     * 
     * @return {Array}
     */
    $.stable.prototype.getFields = function(){
        var fields = [];
        if( this.thereAreExcludes() ){
            for( var a in this.data.fields ) {
                if( this.settings.exclude.indexOf( this.data.fields[a] ) === -1 ){
                    fields[a] = this.data.fields[a];
                }
            }
        } else {
            fields = this.data.fields;
        }
        return fields;
    };
    
    /**
     * Return the rows found
     * 
     * @return {Array}
     */
    $.stable.prototype.getRows = function(){
        return this.data.rows;
    };
    
    /**
     * Return the row total
     * 
     * @return {Number}
     */
    $.stable.prototype.getTotalRows = function(){
        return this.data.totalrow;
    };
    
    /**
     * returns the attributes that will be added to the options
     * 
     * @param {String} 
     */
    $.stable.prototype.getAttributes = function( record ){
        
        if( !this.thereAreAttributes() ){
            return null;
        }
        
        var attr = '';
        for( var x in record ){
            if( this.settings.attributes.indexOf( x ) > -1 ){
                attr += 'data-' + x + '="' + record[x] + '" ';
            }
        }
        
        return attr.trim();
    };
    
    /**
     * Returns the fields that are not excluded in the record
     * 
     * @param {Object} record
     * 
     * @return {Array}
     */
    $.stable.prototype.getNotExcludeField = function( record ){
        
        if( !this.thereAreExcludes() ){
            return record;
        }
        
        var rec = [];
        for( var x in record ){
            if( this.settings.exclude.indexOf( x ) === -1 ){
                rec[x] = record[x];
            }
        }
        
        return rec;
    };
    
    /**
     * Returns the specified options in settings
     * 
     * @return {Array}
     */
    $.stable.prototype.getOptions = function(){        
        return this.settings.options;
    };
    
    /**
     * Returns the html structure of the presentation of the table
     * 
     * @return {String}
     */
    $.stable.prototype.structure = function(){
        var html = '', fields = this.getFields();

        var htmlFields = '', htmlOptions = '';
        for( var x in fields ){
            htmlFields += '<th><a href="' + x + '" class="STABLE_EVENT_ORDER_BY">' + fields[x].replace( /\_/g, ' ' ) + '</a></th>';
            htmlOptions += '<option value="' + x + '">' + fields[x].replace( /\_/g, ' ' ) + '</option>';
        }
        if( this.thereAreOptions() ){
            htmlFields += '<th>Opciones</th>';
        }

        html += '<div class="STABLE_STRUCTURE">';
            // Inicio de los filtros
            html += '<div class="STABLE_FILTERS">';
                html += '<div class="STABLE_SHOW_RCORDS">';
                    html += '<div>';
                        html += 'Record Found: <span class="STABLE_TOTAL_RECORDS">0</span> Showing: ';
                        html += '<select class="STABLE_EVENT_SET_RECORD_PAGE">' + this.getRecordPage() + '</select>';
                    html += '</div>';
                html += '</div>';

                html += '<div class="STABLE_SEARCH_RCORDS">';
                    html += '<div>';
                        html += 'Search By: ';
                        html += '<select class="STABLE_SELECT_FIELD_FILTER">';
                            html += '<option value="all">All Fields</option>';
                            html += htmlOptions;
                        html += '</select>';
                        html += 'Criterion: ';
                        html += '<input type="text" class="STABLE_SEARCH_FILTER" />';
                        html += '<button type="button" class="STABLE_SEARCH_BUTTON_FILTER">Search</button>';
                    html += '</div>';
                html += '</div>';
            html += '</div>';

            html += '<div class="STABLE_CLEAR"></div>';

            html += '<div class="STABLE_PAGINATION">';

                html += '<div class="STABLE_PAGINATION_INFO">';
                    html += 'Page: <span class="STABLE_ACTUAL_PAGE">01</span> of <span class="STABLE_TOTAL_PAGES">1</span>';
                html += '</div>';

                html += '<div class="STABLE_PAGINATION_PAGES">';
                    html += '<ul>';
                        html += '<li class="STABLE_EVENT_START_PAGE"><a href="#">Start</a></li>';
                        html += '<li class="STABLE_EVENT_LESS_PAGE"><a href="#">-' + this.settings.pages + '</a></li>';
                        html += '<li class="STABLE_EVENT_PREVIEWS_PAGE"><a href="#">Previews</a></li>';

                        html += '<li class="STABLE_BUTTONS_PAGINATION">';
                            html += '<ul class="STABLE_BUTTONS_PAGINATION"></ul>';
                        html += '</li>';

                        html += '<li class="STABLE_EVENT_NEXT_PAGE"><a href="#">Next</a></li>';
                        html += '<li class="STABLE_EVENT_MORE_PAGE" ><a href="#">+' + this.settings.pages + '</a></li>';
                        html += '<li class="STABLE_EVENT_END_PAGE"><a href="#">End</a></li>';
                    html += '</ul>';

                html += '</div>';
            html += '</div>';

            html += '<div class="STABLE_CLEAR"></div>';

            html += '<div class="STABLE_CONTENT">';
                html += '<table>';
                    html += '<thead>';
                        html += '<tr>';
                            html += '<th>#</th>';
                            html += htmlFields;
                        html += '</tr>';
                    html += '</thead>';

                    html += '<tbody class="STABLE_RECORDS">';
                    html += '</tbody>';

                    html += '<tfoot>';
                        html += '<tr>';
                            html += '<th>#</th>';
                            html += htmlFields;
                        html += '</tr>';
                    html += '</tfoot>';

                html += '</table>';
            html += '</div>';

            html += '<div class="STABLE_CLEAR"></div>';

            html += '<div class="STABLE_PAGINATION">';

                html += '<div class="STABLE_PAGINATION_INFO">';
                    html += 'Page: <span class="STABLE_ACTUAL_PAGE">01</span> of <span class="STABLE_TOTAL_PAGES">1</span>';
                html += '</div>';

                html += '<div class="STABLE_PAGINATION_PAGES">';
                    html += '<ul>';
                        html += '<li class="STABLE_EVENT_START_PAGE"><a href="#">Start</a></li>';
                        html += '<li class="STABLE_EVENT_LESS_PAGE"><a href="#">-' + this.settings.pages + '</a></li>';
                        html += '<li class="STABLE_EVENT_PREVIEWS_PAGE"><a href="#">Previews</a></li>';

                        html += '<li>';
                            html += '<ul class="STABLE_BUTTONS_PAGINATION"></ul>';
                        html += '</li>';

                        html += '<li class="STABLE_EVENT_NEXT_PAGE"><a href="#">Next</a></li>';
                        html += '<li class="STABLE_EVENT_MORE_PAGE"><a href="#">+' + this.settings.pages + '</a></li>';
                        html += '<li class="STABLE_EVENT_END_PAGE"><a href="#">End</a></li>';
                    html += '</ul>';

                html += '</div>';
            html += '</div>';

        html += '</div>';

        return html;
    };
    
    /**
     * Returns the code html with the records found
     * 
     * @param {Integer} index Index of the record
     * @param {Object} record Data record
     * 
     * @return {String}
     */
    $.stable.prototype.records = function( index, record ){
        var html = '', rec = this.getNotExcludeField( record );
        html += '<tr>';
            html += '<th>' + index + '</th>';
            for( var x in rec ){
                html += '<td>' + rec[x] + '</td>';
            }
            
            if( this.thereAreOptions() ){
                var attributes = this.getAttributes( record );
                html += '<td>';
                var options = this.getOptions();
                for( var y in options ){
                    html += '<i class="fa ' + options[y].icon + ' fa-lg STABLE_ACTION_' + y.toUpperCase() + '" title="' + options[y].title + '" ' + attributes + '></i> &nbsp;';
                }
                html += '</td>';
            }
            
        html += '</tr>';
        return html;
    };
    
    /**
     * Returns the code html whit the pagination buttons
     * 
     * @param {Integer} index Number of the botton
     * 
     * @return {String}
     */
    $.stable.prototype.pagination = function ( index ) {
        var html = '';
        html += '<li class="STABLE_EVENT_PAGINATION">';
            html += '<a href="#" data-page="' + index + '">' + ( index < 10 ? '0' + index : index ) + '</a>';
        html += '</li>';
        return html;
        
    };
    
    /**
     * Returns the code html with message error
     * 
     * @return {String}
     */
    $.stable.prototype.errorMessage = function(){
        var html = '';
        html += '<div class="STABLE_ERROR">';
            html += '<b>Stable Ascyn</b> no se ha podido cargar correctamente debido a un error inesperado!';
        html += '</div>';
        return html;
    };
    
    /**
     * Returns the code html whit message load
     * 
     * @return {String}
     */
    $.stable.prototype.loadingMessage = function(){
        var html = '';
        html += '<div class="STABLE_LOADING">';
            html += '<b>Stable Ascyn</b> está cargando los datos, por favor espere...';
        html += '</div>';
        return html;
    };
    
    /**
     * Initial request to start the stable
     * 
     * @return {Null}
     */
    $.stable.prototype.getDataServer = function ( callback ){
        var STABLE = this;
        $.ajax({
            url: STABLE.settings.url,
            success: function( response ){
                STABLE.data = response;
                
                STABLE.generateContent();
                
                if( callback !== undefined ){
                    callback();
                }
                
                STABLE.element.find( '.STABLE_LOADING' ).remove();
            }
        });
    };
    
    /**
     * Request to respond to each change of stable
     */
    $.stable.prototype.getDataServerPage = function ( callback ) {
        var STABLE = this;
        $.ajax({
            url: STABLE.settings.url,
            beforeSend: function () {
                STABLE.busy = true;
                STABLE.element.find( '.STABLE_CONTENT' ).prepend( STABLE.loadingMessage() );
            },
            success: function ( response ) {
                STABLE.data = response;
                STABLE.updateContent();

                if ( callback !== undefined ) {
                    callback();
                }
                
                STABLE.element.find( '.STABLE_LOADING' ).remove();
                STABLE.element.trigger( 'stable:change' );
                STABLE.busy = false;
            }
        });
    };
    
    /**
     * Renders the content once the stable is loaded
     * 
     * @return {Null}
     */
    $.stable.prototype.generateContent = function(){
        
        if( this.totalrow_cached === 0 ){
            this.totalrow_cached = parseInt( this.getTotalRows() );
        }
        
        var contentHtml = this.structure();
        
        this.element.html( contentHtml );
        
        this.updateRecords();
        
        // Calculando el total de paginas
        this.total_pages = this.generatePage();
        this.total_sub_page = this.generatePage( this.total_pages, this.settings.pages );
        
        // Generando los botones de la paginacion
        this.generateNumericPaginationButtons();
        
        this.element.find( '.STABLE_TOTAL_RECORDS' ).text( this.data.totalrow );
        this.element.find( '.STABLE_TOTAL_PAGES' ).text( this.total_pages );
        
        if( this.total_pages <= 1 ){
            this.element.find('.STABLE_PAGINATION').hide();
        }
        
        // Active the events for the pagination and filters
        var dataEventPagination = { id: this.element.attr('id') };
        this.element.on( 'click', '.STABLE_EVENT_PAGINATION a', dataEventPagination, eventPagination );
        this.element.on( 'click', '.STABLE_EVENT_NEXT_PAGE a', dataEventPagination, nextPage );
        this.element.on( 'click', '.STABLE_EVENT_PREVIEWS_PAGE a', dataEventPagination, previewsPage );
        this.element.on( 'click', '.STABLE_EVENT_MORE_PAGE a', dataEventPagination, morePage );
        this.element.on( 'click', '.STABLE_EVENT_LESS_PAGE a', dataEventPagination, lessPage );
        this.element.on( 'click', '.STABLE_EVENT_START_PAGE a', dataEventPagination, startPage );
        this.element.on( 'click', '.STABLE_EVENT_END_PAGE a', dataEventPagination, endPage );
        
        if( this.settings.orderBy ){
            this.element.on( 'click', '.STABLE_EVENT_ORDER_BY', dataEventPagination, orderByData );
        }
        
        if( !this.settings.search ){
            this.element.find('.STABLE_SEARCH_RCORDS').remove();
        } else {
            this.element.on( 'keyup', '.STABLE_SEARCH_FILTER', dataEventPagination, searchFilter );
            this.element.on( 'click', '.STABLE_SEARCH_BUTTON_FILTER', dataEventPagination, buttonSearch );
            this.element.on( 'change', '.STABLE_SELECT_FIELD_FILTER', dataEventPagination, changeFieldFilter );
        }
        
        if( !this.settings.recordPerPage ){
            this.element.find('.STABLE_SHOW_RCORDS').remove();
        } else {
            this.element.on( 'change', '.STABLE_EVENT_SET_RECORD_PAGE', dataEventPagination, recordPerPage );
        }
        
    };
    
    /**
     * Refreshes the content of stable
     * 
     * @return {Null}
     */
    $.stable.prototype.updateContent = function(){
        this.updateRecords();
    };
    
    /**
     * Notifies if the records had some change
     * 
     * @return {Null}
     */
    $.stable.prototype.changeRecords = function(){};
    
    /**
     * Update search filters before sending the request to the server
     * 
     * @return {Null}
     */
    $.stable.prototype.setFilter = function(){
        
        var input  = this.element.find('.STABLE_SEARCH_FILTER').val();
        var select = this.element.find('.STABLE_SELECT_FIELD_FILTER').val();
        
        if( input === "" ){
            input  = null;
            select = null;
        }
        
        $.ajaxSetup({
            data: {
                rows:       this.settings.row,
                page:       this.actual_page,
                field:      select,
                str:        input,
                fieldorder: this.orderby.field,
                typeorder:  this.orderby.type
            }
        });
    };
    
    /**
     * Switches the order of the records
     * 
     * @param {Integer} field Number of the field to order
     * 
     * @return {Null}
     */
    $.stable.prototype.setOrderBy = function( field ){
        
        if( !this.orderby.ascDesc ){
            this.orderby.ascDesc = true;
            this.orderby.type = 'ASC';
        } else {
            this.orderby.ascDesc = false;
            this.orderby.type = 'DESC';
        }
        
        this.orderby.field = field;
        
        this.resetPagination();
    };
    
    /**
     * Update the records
     * 
     * @return {Null}
     */
    $.stable.prototype.updateRecords = function(){
        this.changeRecords();
        var index = ( this.actual_page - 1 ) * this.settings.row;
        var records  = '';       
        for( var x in this.data.rows ) {
            index++;
            records += this.records( index, this.data.rows[x] );
        }
        
        this.element.find( '.STABLE_RECORDS' ).html( records );
    };
    
    /**
     * Calculate the total pages
     * 
     * @param {integer} total Total of records found
     * @param {integer} row   Quantity of records to show by page
     * 
     * @return {Integer}
     */
    $.stable.prototype.generatePage = function ( total, row ) {
        
        var totalrow = total === undefined ? parseInt( this.data.totalrow ) : total;
        var showrow  = row === undefined ? parseInt( this.settings.row ): row;
        
        var page = Math.floor( totalrow / showrow );
        
        page = totalrow % showrow !== 0 ? page + 1 : page;
        
        return page;
    };
    
    /**
     * Returns the current sub page
     * 
     * @return {Number}
     */
    $.stable.prototype.getSubActualPage = function(){
        var entero = Math.floor( this.actual_page / this.settings.pages );
        if ( this.actual_page % this.settings.pages === 0 ) {
            entero--;
        }
        return entero;
    };
    
    /**
     * Calculated the range of the numeric buttons for the pagination
     * 
     * @return {Object}
     */
    $.stable.prototype.getRangePagination = function () {
        
        if( this.total_pages <= this.settings.pages ) {
            return {ini: 1, fin: this.total_pages };
        }
        
        var ini = ( this.actual_sub_page * this.settings.pages ) + 1;
        var fin = ( this.actual_sub_page + 1 ) * this.settings.pages;
        fin = fin > this.total_pages ? this.total_pages : fin;
        
        return { ini: ini, fin: fin };
    };
    
    /**
     * Generates the paging buttons
     * 
     * @return {Null}
     */
    $.stable.prototype.generateNumericPaginationButtons = function(){
        var range = this.getRangePagination();
        var buttons = '';
        for ( var x = range.ini; x <= range.fin; x++ ) {
            buttons += this.pagination( x );
        }
        this.element.find( '.STABLE_BUTTONS_PAGINATION' ).html( buttons );
        this.element.find( '.STABLE_BUTTONS_PAGINATION li a[data-page=' + this.actual_page + ']' ).addClass( 'active' );
    };
    
    /**
     * Update the pagination
     * 
     * @return {Null}
     */
    $.stable.prototype.updatePagination = function(){
        this.total_pages = this.generatePage();
        this.total_sub_page = this.generatePage( this.total_pages, this.settings.pages );
        this.generateNumericPaginationButtons();
        this.element.find( '.STABLE_TOTAL_RECORDS' ).text( this.data.totalrow );
        this.element.find( '.STABLE_TOTAL_PAGES' ).text( this.total_pages < 10 ? '0' + this.total_pages : this.total_pages );
        this.element.find( '.STABLE_ACTUAL_PAGE' ).text( this.actual_page < 10 ? '0' + this.actual_page : this.actual_page );

        if( this.total_pages <= 1 ){
            this.element.find('.STABLE_PAGINATION').hide();
        } else {
            this.element.find('.STABLE_PAGINATION').show();
        }
    };
    
    /**
     * Reset pagination
     * 
     * @return {Null}
     */
    $.stable.prototype.resetPagination = function(){
        var STABLE = this;
        
        this.actual_page = 1;
        this.actual_sub_page = 0;
        
        this.setFilter();
        
        this.getDataServerPage(function(){
            STABLE.updatePagination();
        });
    };
    
    /**
     * Receive the event search to search for a phrase or criterion
     * 
     * @return {Null}
     */
    $.stable.prototype.searchByCriterion = function(){
        this.resetPagination();
    };
    
    /**
     * Update the information page
     * 
     * @retun {Null}
     */
    $.stable.prototype.updateViewInfoPage = function(){
        this.element.find( '.STABLE_ACTUAL_PAGE' ).text( this.actual_page < 10 ? '0' + this.actual_page : this.actual_page );
        this.element.find( '.STABLE_EVENT_PAGINATION a' ).removeClass('active');
        this.element.find( '.STABLE_EVENT_PAGINATION a[data-page="' + this.actual_page + '"]' ).addClass('active');
    };
    
    /**
     * Change page
     * 
     * @param {integer} action   Action to be exercised in the pagination
     * @param {integer} page     Page number change
     * @param {integer} startend Beginning or end of page
     * 
     * @return {Null}
     */
    $.stable.prototype.changePage = function( action, page, startend ){
        
        switch( action ){
            // EventPagination
            case 0:
                if( this.actual_page !== page || startend === 1 ){
                    this.actual_page = page;
                } else {
                    return false;
                }
            break;
            
            // More Pages
            case 1:
                if( this.actual_page < this.total_pages ){
                    this.actual_page++;
                } else {
                    return false;
                }
            break;
            
            // Less Pages
            case 2:
                if( this.actual_page > 1 ){
                    this.actual_page--;
                } else {
                    return false;
                }
            break;
        }
        
        
        if( action !== 0 ){
            var sub_page = this.getSubActualPage();
            if( sub_page !== this.actual_sub_page ){
                this.actual_sub_page = sub_page;
                this.generateNumericPaginationButtons();
            }
        }
        
        this.updateViewInfoPage();
        
        // Update the filter of the search
        this.setFilter();
        
        // Sending request to server
        this.getDataServerPage();
    };
    
    
    /**
     * Change a sub pagination
     * 
     * @return {Null}
     */
    $.stable.prototype.moreAndLessPage = function( action, end ){
        
        switch( action ){
            case 1:
                if( this.actual_sub_page < ( this.total_sub_page -1 ) ){
                    this.actual_sub_page++;
                } else {
                    return false;
                }
            break;
            case 2:
                if( this.actual_sub_page > 0 ){
                    this.actual_sub_page--;
                } else {
                    return false;
                }
            break;
            case 3:
                if( this.actual_page !== this.total_pages ){
                    this.actual_page = this.total_pages;
                    this.actual_sub_page = this.getSubActualPage();
                } else {
                    return false;
                }
            break;
            case 4:
                if( this.actual_page !== 1 ){
                    this.actual_page = 1;
                    this.actual_sub_page = this.getSubActualPage();
                } else {
                    return false;
                }
            break;
        }
        
        this.generateNumericPaginationButtons();
        
        if( end === 1 ){
            this.element.find('.STABLE_BUTTONS_PAGINATION li:last-child a').trigger('click', 1 );
        } else {
            this.element.find('.STABLE_BUTTONS_PAGINATION li:first-child a').trigger('click', 1 );
        }
    };
    
    /**
     * Change the number of records per page to be displayed
     * 
     * @return {Null}
     */
    $.stable.prototype.setRecordPage = function( rows ){
        this.settings.row = rows;
        this.resetPagination();
    };
    
    /**
     * Generates options combo of records per page
     * 
     * @return {String}
     */
    $.stable.prototype.getRecordPage = function () {
        
        var total = this.totalrow_cached;
        var row = parseInt( this.combo_row );
        
        var html = '';
        if ( total <= 2000 ){
            html += '<option value="' + total + '">All Records</option>';
        }
        var n = row;
        var n2 = row;
        var x = 0;
        while ( n <= total && n < 2000 ) {
            html += '<option value="' + n + '" ' + ( n === row ? 'selected="selected"' : '' ) + '>' + n + '</option>';
            if( ++x < row ){
                n = n + n2;
            } else {
                n = n * 2;
                n2 = n;
                x = 0;
            }
        }
        return html;
    };
    
    /**
     * Extending jquery plugin
     */
    $.fn.extend({
        stable: function( settings ){
            
            if( settings.url === undefined ){
                console.error('FATAL ERROR: URL Not Found');
                return false;
            }
            
            var element = this, id = element.attr('id');
            
            var overrideSettings = {};
            $.extend( overrideSettings, defaultSettings, settings );
            
            $.ajaxSetup({
                type: 'POST',
                dataType: 'json',
                cache: false,
                data: {
                    rows: overrideSettings.row,
                    page: 1
                },
                beforeSend: function () {
                    instance[ id ].element.prepend( instance[ id ].loadingMessage() );
                },
                error: function( jqXHR, textStatus, errorThrown ){
                    instance[ id ].element.html( instance[ id ].errorMessage() );
                    console.error( jqXHR.responseText );
                }
            });
            
            instance[ id ] = new $.stable( element, overrideSettings );
            
            var stableData = sessionStorage.getItem( 'stableData' );
            if ( stableData !== null ) {
                var storage = JSON.parse( stableData );
                if( id in storage ){
                    $.extend( instance[ id ], storage[ id ].stableObject );
                    instance[ id ].totalrow_cached = parseInt( storage[ id ].stableFilter.totalrow_cached );
                    instance[ id ].setFilter();
                    $.ajaxSetup({
                        data: {
                            field: storage[ id ].stableFilter.field_search,
                            str: storage[ id ].stableFilter.string_search,
                            rows: storage[ id ].stableFilter.record_per_page
                        }
                    });
                    instance[ id ].settings.row = storage[ id ].stableFilter.record_per_page;
                }
            }
            
            instance[ id ].getDataServer(function(){
                instance[ id ].updateViewInfoPage();
                if( stableData !== null && id in storage ){
                    instance[ id ].updatePagination();
                    instance[ id ].element.find( '.STABLE_SEARCH_FILTER' ).val( storage[ id ].stableFilter.string_search );
                    instance[ id ].element.find( '.STABLE_SELECT_FIELD_FILTER' ).val( storage[ id ].stableFilter.field_search );
                    instance[ id ].element.find( '.STABLE_EVENT_SET_RECORD_PAGE' ).val( storage[ id ].stableFilter.record_per_page );
                }
                
                element.trigger( 'stable:ready' );
            });
            
            element.on( 'stable:update', function(){
                instance[ id ].getDataServerPage();
            });
            
            return this;
        }
    });
    
    /**
     * Saves the last state of the stable in the sessionStorage
     * 
     * @returns {Null}
     */
    window.onbeforeunload = function(){
                 
        var storage = {}, st = false;
        
        for ( var x in instance ) {
            if( instance[x].settings.storage ){
                storage[x] = { stableObject:{}, stableFilter:{} } ;
            
                storage[x].stableObject.actual_page = instance[x].actual_page;
                storage[x].stableObject.actual_sub_page = instance[x].actual_sub_page;
                storage[x].stableObject.orderby = instance[x].orderby;
                storage[x].stableObject.total_pages = instance[x].total_pages;
                storage[x].stableObject.total_sub_page = instance[x].total_sub_page;

                storage[x].stableFilter.string_search = instance[x].element.find( '.STABLE_SEARCH_FILTER' ).val();
                storage[x].stableFilter.field_search = instance[x].element.find( '.STABLE_SELECT_FIELD_FILTER' ).val();
                storage[x].stableFilter.record_per_page = instance[x].element.find( '.STABLE_EVENT_SET_RECORD_PAGE' ).val();
                storage[x].stableFilter.totalrow_cached = instance[x].totalrow_cached;
                st = true;
            }
        }
        
        if ( st ) {
            sessionStorage.setItem( 'stableData', JSON.stringify( storage ) );
        }
     };
    
})( jQuery );
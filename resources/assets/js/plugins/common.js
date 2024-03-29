$(document).ready(function () {

    $(".notifications-menu").on("hide.bs.dropdown", function(event){

        $.ajax({
            type: 'GET',
            url: '/admin/notification/clearcurrentnotifications',
            dataType: "JSON",
            success: function(data){
                getNotifications();
            }
        });

    });

    getNotifications();
    setInterval(function () {
        getNotifications();
    }, 60000);
});

function addDeleteForms() {
    $('[data-method]').append(function () {
        if (! $(this).find('form').length > 0)
            return "\n" +
                "<form action='" + $(this).attr('href') + "' method='POST' name='delete_item' style='display:none'>\n" +
                "   <input type='hidden' name='_method' value='" + $(this).attr('data-method') + "'>\n" +
                "   <input type='hidden' name='_token' value='" + $('meta[name="csrf-token"]').attr('content') + "'>\n" +
                "</form>\n";
        else
            return "";
    })
        //.removeAttr('href')
        .attr('href', '#')
        .attr('style', 'cursor:pointer;')
        .attr('onclick', '$(this).find("form").submit();');
}

function getNotifications() {
    $.ajax({
        type: "GET",
        url: '/admin/notification/getlist',
        dataType: "JSON",
        success: function (result) {
            $(".notification-counter").text(result.count);
            $(".notification-menu-container").html(result.view);
        }
    });
}

function bootstrapClearButton() {
  $('.position-relative :input').on('keydown focus', function() {
    if ($(this).val().length > 0) {
      $(this).nextAll('.form-clear').removeClass('d-none');
    }
  }).on('keydown keyup blur', function() {
    if ($(this).val().length === 0) {
      $(this).nextAll('.form-clear').addClass('d-none');
    }
  });
  $('.form-clear').on('click', function() {
    $(this).addClass('d-none').prevAll(':input').val('');
  });
}

$(function () {
    /**
     * Place the CSRF token as a header on all pages for access in AJAX requests
     */
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    /**
     * Add the data-method="delete" forms to all delete links
     */
    addDeleteForms();

    /**
     * This is for delete buttons that are loaded via AJAX in datatables, they will not work right
     * without this block of code
     */
    $(document).ajaxComplete(function(){
        addDeleteForms();
    });

    /**
     * Generic confirm form delete using Sweet Alert
     */
    $('body').on('submit', 'form[name=delete_item]', function(e){
        e.preventDefault();
        var form = this;
        var link = $('a[data-method="delete"]');
        var cancel = (link.attr('data-trans-button-cancel')) ? link.attr('data-trans-button-cancel') : "Anuluj";
        var confirm = (link.attr('data-trans-button-confirm')) ? link.attr('data-trans-button-confirm') : "Tak, Usuwaj";
        var title = (link.attr('data-trans-title')) ? link.attr('data-trans-title') : "Uwaga";
        var text = (link.attr('data-trans-text')) ? link.attr('data-trans-text') : "Czy na pewno chcesz usunąć ten element?";

        Swal.fire({
            title: title,
            type: "warning",
            showCancelButton: true,
            cancelButtonText: cancel,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: confirm
        }).then(result => {
            if (result.value){
                form.submit();
            }
        });
    });

    /**
     * Generic 'are you sure' confirm box
     */
    /**
    $('body').on('click', 'a[name=confirm_item]', function(e){
        e.preventDefault();
        var link = $(this);
        var title = (link.attr('data-trans-title')) ? link.attr('data-trans-title') : "Czy na pewno chcesz to zrobić?";
        var cancel = (link.attr('data-trans-button-cancel')) ? link.attr('data-trans-button-cancel') : "Anuluj";
        var confirm = (link.attr('data-trans-button-confirm')) ? link.attr('data-trans-button-confirm') : "Dalej";

        swal({
            title: title,
            type: "info",
            showCancelButton: true,
            cancelButtonText: cancel,
            confirmButtonColor: "#3C8DBC",
            confirmButtonText: confirm
        }, function(confirmed) {
            if (confirmed)
                window.location = link.attr('href');
        });
    });
    */
    /**
     * Bind all bootstrap tooltips
     */
    $('body').tooltip({ selector: '[data-toggle=tooltip]' });

    /**
     * Bind all bootstrap popovers
     */
    $('body').popover({ selector: '[data-toggle=popover]' });

    /**
     * This closes the popover when its clicked away from
     */
    $('body').on('click', function (e) {
        $('[data-toggle="popover"]').each(function () {
            if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
                $(this).popover('hide');
            }
        });
    });
})


//common functionalities for all the javascript featueres
var Backend = {}; // common variable used in all the files of the backend

(function () {

    Backend = {

        Utils: {
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            toggleClass: function (element, className) {
                if (element.classList) {
                    element.classList.toggle(className);
                } else {
                    var classes = element.className.split(' ');
                    var existingIndex = classes.indexOf(className);

                    if (existingIndex >= 0)
                        classes.splice(existingIndex, 1);
                    else
                        classes.push(className);

                    element.className = classes.join(' ');
                }
            },
            addClass: function (element, className) {
                if (element.classList)
                    element.classList.add(className);
                else
                    element.className += ' ' + className;
            },
            removeClass: function (el, className) {
                if (el.classList)
                    el.classList.remove(className);
                else
                    el.className = el.className.replace(new RegExp('(^|\\b)' + className.split(' ').join('|') + '(\\b|$)', 'gi'), ' ');
            },

            documentReady: function (callback) {
                if (document.attachEvent ? document.readyState === "complete" : document.readyState !== "loading") {
                    callback();
                } else {
                    document.addEventListener('DOMContentLoaded', callback);
                }
            },

            ajaxrequest: function (url, method, data, csrf, callback) {
                var request = new XMLHttpRequest();
                var loadingIcon = $(".loading");
                if (window.XMLHttpRequest) {
                    // code for modern browsers
                    request = new XMLHttpRequest();
                } else {
                    // code for old IE browsers
                    request = new ActiveXObject("Microsoft.XMLHTTP");
                }
                request.open(method, url, true);

                request.onloadstart = function () {
                    loadingIcon.show();
                };
                request.onloadend = function () {
                    loadingIcon.hide();
                };
                request.setRequestHeader('X-CSRF-TOKEN', csrf);
                request.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
                if ("post" === method.toLowerCase() || "patch" === method.toLowerCase()) {
                    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
                    data = this.jsontoformdata(data);
                }

                // when request is in the ready state change the details or perform success function
                request.onreadystatechange = function () {
                    if (request.readyState === XMLHttpRequest.DONE) {
                        // Everything is good, the response was received.
                        request.onload = callback.success(request);
                    }
                };
                request.onerror = callback.error;
                request.send(data);
            },

            // This should probably only be used if all JSON elements are strings
            jsontoformdata: function (srcjson) {
                if (typeof srcjson !== "object")
                    if (typeof console !== "undefined") {
                        return null;
                    }
                u = encodeURIComponent;
                var urljson = "";
                var keys = Object.keys(srcjson);
                for (var i = 0; i < keys.length; i++) {
                    urljson += u(keys[i]) + "=" + u(srcjson[keys[i]]);
                    if (i < (keys.length - 1)) urljson += "&";
                }
                return urljson;
            },

        },

        /**
         * Roles management
         */
        Roles: {
            selectors: {
                associated: document.querySelector("select[name='associated_permissions']"),
                associated_container: document.getElementById("#available-permissions"),
            },
            init: function (page) {
                this.setSelectors();
                this.setRolepermission(page);
                this.addHandlers();
            },
            setSelectors: function () {
                this.selectors.associated = document.querySelector("select[name='associated_permissions']");
                this.selectors.associated_container = document.getElementById("available-permissions");
            },
            addHandlers: function () {
                var associated = this.selectors.associated;
                var associated_container = this.selectors.associated_container;

                if (associated_container != null)
                    if (associated.value == "custom")
                        Backend.Utils.removeClass(associated_container, "d-none");
                    else
                        Backend.Utils.addClass(associated_container, 'd-none');

                associated.onchange = function (event) {
                    if (associated_container != null)
                        if (associated.value == "custom")
                            Backend.Utils.removeClass(associated_container, "d-none");
                        else
                            Backend.Utils.addClass(associated_container, 'd-none');
                };
            },
            setRolepermission: function (page) {
                Backend.Users.setSelectors();
                Backend.Users.addHandlers(page);
            }

        },
        /**
         * Users management
         *
         */
        Users: {
            selectors: {
                select2: $(".select2"),
                getPremissionURL: "",
                showPermission: document.querySelectorAll(".show-permissions")
            },
            init: function (page) {
                this.setSelectors();
                this.addHandlers(page);
            },
            setSelectors: function () {
                this.selectors.select2 = $(".select2");
                this.selectors.getRoleForPermissions = document.querySelectorAll(".get-role-for-permissions");
                this.selectors.getAvailabelPermissions = document.querySelector(".get-available-permissions");
                this.selectors.Role3 = document.getElementById("role-3");
                this.showPermission = document.querySelectorAll(".show-permissions");
            },
            addHandlers: function (page) {
                /**
                 * This function is used to get clicked element role id and return required result
                 */

                this.selectors.getRoleForPermissions.forEach(function (element) {
                    element.onclick = function (event) {
                        callback = {
                            success: function (request) {
                                if (request.status >= 200 && request.status < 400) {
                                    // Success!
                                    var response = JSON.parse(request.responseText);
                                    var permissions = response.permissions;
                                    var rolePermissions = response.rolePermissions;
                                    var allPermisssions = response.allPermissions;

                                    Backend.Users.selectors.getAvailabelPermissions.innerHTML = "";
                                    htmlstring = "";
                                    if (permissions.length == 0) {
                                        Backend.Users.selectors.getAvailabelPermissions.innerHTML = '<p>Brak dostępnych Uprawnień.</p>';
                                    } else {
                                        for (var key in permissions) {
                                            var addChecked = '';
                                            if (allPermisssions == 1 && rolePermissions.length == 0) {
                                                addChecked = 'checked="checked"';
                                            } else {
                                                if (typeof rolePermissions[key] !== "undefined") {
                                                    addChecked = 'checked="checked"';
                                                }
                                            }
                                            htmlstring += '<div class="form-check"><label  for="perm_' + key + '" class="form-check-label"><input class="form-check-input" type="checkbox" name="permissions[' + key + ']" value="' + key + '"  id="perm_' + key + '" ' + addChecked + ' />' + permissions[key] + '<span class="form-check-sign"><span class="check"></span></span></label></div><br>';
                                        
                                        }
                                    }
                                    Backend.Users.selectors.getAvailabelPermissions.innerHTML = htmlstring;
                                    Backend.Utils.removeClass(document.getElementById("available-permissions"), 'd-none');

                                } else {
                                    // We reached our target server, but it returned an error
                                    Backend.Users.selectors.getAvailabelPermissions.innerHTML = '<p>Brak dostępnych Uprawnień.</p>';
                                }
                            },
                            error: function () {
                                Backend.Users.selectors.getAvailabelPermissions.innerHTML = '<p>Brak dostępnych Uprawnień.</p>';
                            }
                        };

                        Backend.Utils.ajaxrequest(Backend.Users.selectors.getPremissionURL, "post", {
                            role_id: event.target.value
                        }, Backend.Utils.csrf, callback);
                    };
                });
                if (page == "create") {
                    Backend.Users.selectors.Role3.click();
                }

                this.selectors.select2.select2();

            },
            windowloadhandler: function () {

                // scripts to be handeled on user create and edit when window is laoaded
                Backend.Users.selectors.showPermission.forEach(function (element) {
                    element.onclick = function (event) {
                        event.preventDefault();
                        var $this = this;
                        var role = $this.getAttribute("data-role");

                        var permissions = document.querySelector(".permission-list[data-role='" + role + "']");
                        var hideText = $this.querySelector('.hide-text');
                        var showText = $this.querySelector('.show-text');

                        // show permission list
                        Backend.Utils.toggleClass(permissions, 'd-none');

                        // toggle the text Show/Hide for the link
                        Backend.Utils.toggleClass(hideText, 'd-none');
                        Backend.Utils.toggleClass(showText, 'd-none');
                    };
                });
            }
        },

        /**
         * Users delete page
         *
         */

        UserDeleted: {
            selectors: {
                AlldeletePerms: document.querySelectorAll("a[name='delete_user_perm']"),
                AllrestorePerms: document.querySelectorAll("a[name='restore_user']"),
                Areyousure: "Czy na pewno?",
                delete_user_confirm: "Potwierdź usunięcie Użytkownika",
                continue: "Dalej",
                cancel: "Anuluj",
                restore_user_confirm: "Potwierdź przywrócenie Użytkownika",
            },
            setSelectors: function () {
                this.selectors.AlldeletePerms = document.querySelectorAll("a[name='delete_user_perm']");
                this.selectors.AllrestorePerms = document.querySelectorAll("a[name='restore_user']");
            },
            windowloadhandler: function () {
                this.setSelectors();
                /*
                    deleted page showing the swal when click on peremenenant delition
                 */
                this.selectors.AlldeletePerms.forEach(function (element) {
                    element.onclick = function (event) {
                        event.preventDefault();
                        var linkURL = this.getAttribute("href");

                        Swal.fire({
                            title: Backend.UserDeleted.selectors.Areyousure,
                            text: Backend.UserDeleted.selectors.delete_user_confirm,
                            type: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: Backend.UserDeleted.selectors.continue,
                            cancelButtonText: Backend.UserDeleted.selectors.cancel
                        }).then(result => {
                            if (result.value){
                                window.location.href = linkURL;
                            }
                        });
                    };
                });
                /**
                 * deleted user page handeler for user restore
                 */
                this.selectors.AllrestorePerms.forEach(function (element) {

                    element.onclick = function (event, element) {
                        event.preventDefault();

                        var linkURL = this.getAttribute("href");

                        Swal.fire({
                            title: Backend.UserDeleted.selectors.Areyousure,
                            text: Backend.UserDeleted.selectors.restore_user_confirm,
                            type: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: Backend.UserDeleted.selectors.continue,
                            cancelButtonText: Backend.UserDeleted.selectors.cancel
                        }).then(result => {
                            if (result.value){
                                window.location.href = linkURL;
                            }
                        });
                    };
                });
            }
        },
        /**
         * Clients management
         *
         */
        Clients: {
            selectors: {
                coordinates: document.querySelectorAll(".coordinates"),
                latField: document.getElementById("input-adr_lattitude"),
                lonField: document.getElementById("input-adr_longitude"),
                coordinatesURL: "",
            },
            regions: {
                    "02":"dolnośląskie",
                    "04":"kujawsko-pomorskie",
                    "06":"lubelskie",
                    "08":"lubuskie",
                    "10":"łódzkie",
                    "12":"małopolskie",
                    "14":"mazowieckie",
                    "16":"opolskie",
                    "18":"podkarpackie",
                    "20":"podlaskie",
                    "22":"pomorskie",
                    "24":"śląskie",
                    "26":"świętokrzyskie",
                    "28":"warmińsko-mazurskie",
                    "30":"wielkopolskie",
                    "32":"zachodniopomorskie"
            },
            init: function () {
                this.setSelectors();
                this.addHandlers();
            },
            setSelectors: function () {
                this.selectors.coordinates = document.querySelectorAll(".coordinates");
            },
            addHandlers: function () {
                /**
                 * This function is used to get client address and return coordinates
                 */

                this.selectors.coordinates.forEach(function (element) {
                    element.onclick = function (event) {
                        event.preventDefault();

                        let road = $("input[name=adr_street]").val();
                        let house_number = $("input[name=adr_street_nr]").val();
                        let town = $("input[name=adr_city]").val();
                        let state = Backend.Clients.regions[$("select[name=adr_region]").val()];
                        let country = $("input[name=adr_country]").val();
                        let postalcode = $("input[name=adr_zipcode]").val();

                        let searchString = "street="+house_number+" "+road+"&city="+town+"&state="+state+"&country="+country+"&postalcode="+postalcode;

                        callback = {
                            success: function (request) {
                                if (request.status >= 200 && request.status < 400) {
                                    //Success
                                    var json = JSON.parse(request.responseText);
                                    Backend.Clients.selectors.latField.value = json[0].lat;
                                    Backend.Clients.selectors.lonField.value = json[0].lon;
                                    Backend.Clients.selectors.latField.parentNode.classList.add("is-filled");
                                    Backend.Clients.selectors.lonField.parentNode.classList.add("is-filled");
                                }
                                else {
                                    // We reached our target server, but it returned an error
                                    console.log("Nie udało się połączyć z serwerem Geokodowania.");
                                }

                            },
                            error: function () {
                                
                            }
                        };

                        Backend.Utils.ajaxrequest(Backend.Clients.selectors.coordinatesURL, "post", {
                            data: searchString
                        }, Backend.Utils.csrf, callback);
                    };
                });
            },
            windowloadhandler: function () {
                this.setSelectors();
            }
        },
        /**
         * Service management
         *
         */
        Service: {
            selectors: {
                client: $(".select2.client-select"),
                servicecat: $(".select2.servicecat-select"),
                model: $(".select2.model-select"),
            },
            init: function () {
                this.setSelectors();
                this.addHandlers();                
            },
            setSelectors: function () {
                this.selectors.client = $(".select2.client-select");
                this.selectors.servicecat = $(".select2.servicecat-select");
                this.selectors.model = $(".select2.model-select");
            },
            addHandlers: function(){
                this.selectors.client.select2({
                    placeholder: "Wybierz Klienta",
                    theme: "material"
                });
                this.selectors.servicecat.select2({
                    placeholder: "Wybierz Typ Usługi",
                    theme: "material"
                });
                this.selectors.model.select2({
                    placeholder: "Wybierz Model",
                    theme: "material"
                });
            }
        },
        /**
         * Service Category management
         *
         */
        ServiceCat: {
            selectors: {
                type: $(".select2"),
            },
            init: function () {
                this.setSelectors();
                this.addHandlers();                
            },
            setSelectors: function () {
                this.selectors.type = $(".select2");
            },
            addHandlers: function(){
                this.selectors.type.select2({
                    placeholder: "Wybierz Rodzaj",
                    theme: "material"
                });
            }
        },
        /**
         * Task management
         *
         */
        Task: {
            selectors: {
                service: $(".select2.service-select"),
                assignee: $(".select2.assignee-select"),
                type: $(".select2.type-select"),
            },
            init: function () {
                this.setSelectors();
                this.addHandlers();                
            },
            setSelectors: function () {
                this.selectors.service = $(".select2.service-select");
                this.selectors.assignee = $(".select2.assignee-select");
                this.selectors.type = $(".select2.type-select");
            },
            addHandlers: function(){
                this.selectors.service.select2({
                    placeholder: "Wybierz Usługę",
                    theme: "material"
                });
                this.selectors.assignee.select2({
                    placeholder: "Wybierz Pracownika",
                    theme: "material"
                });
                this.selectors.type.select2({
                    placeholder: "Wybierz Rodzaj",
                    theme: "material"
                });
            }
        },
        /**
         * Model management
         *
         */
        Model: {
            selectors: {
                producer: $(".select2"),
            },
            init: function () {
                this.setSelectors();
                this.addHandlers();                
            },
            setSelectors: function () {
                this.selectors.producer = $(".select2");
            },
            addHandlers: function(){
                this.selectors.producer.select2({
                    placeholder: "Wybierz Producenta",
                    theme: "material"
                });
            }
        },
        /**
         * Menu management
         *
         */
        Menu: {
            selectors: {
                menuItemContainer: $("#menu-items"),
                menuItemsData: $(".menu-items-field"),
                addCustomUrlButton: $(".show-modal"),
                modal: $("#showMenuModal"),
                document: $("document"),
                addCustomUrlForm: "#menu-add-custom-url",
                addModuleToMenuButton: ".add-module-to-menu",
                removeMenuItemButton: ".remove-menu-item",
                editMenuItemButton: ".edit-menu-item",
                formUrl: "",
            },

            methods: {
                getNewId: function (str) {
                    var arr = str.match(/"id":[0-9]+/gi);
                    if (arr) {
                        $.each(arr, function (index, item) {
                            arr[index] = parseInt(item.replace('"id":', ''));
                        });
                        return Math.max.apply(Math, arr) + 1;
                    }
                    return 1;
                },

                findItemById: function (item, id) {
                    if (item.id == id) {
                        return item;
                    }
                    var found = false;
                    var foundItem;
                    if (item.children) {
                        $.each(item.children, function (index, childItem) {
                            foundItem = Backend.Menu.methods.findItemById(childItem, id);
                            if (foundItem) {
                                found = true;
                                return false;
                            }
                        });
                    }
                    if (found) {
                        return foundItem;
                    }
                    return null;
                },

                addMenuItem: function (obj) {
                    Backend.Menu.selectors.menuItemContainer.nestable('add', {
                        "id": Backend.Menu.methods.getNewId(Backend.Menu.selectors.menuItemsData.val()),
                        "content": obj.name,
                        "name": obj.name,
                        "url": obj.url,
                        "url_type": obj.url_type,
                        "open_in_new_tab": obj.open_in_new_tab,
                        "icon": obj.icon,
                        "view_permission_id": obj.view_permission_id
                    });
                    Backend.Menu.selectors.menuItemsData.val(
                        JSON.stringify(
                            Backend.Menu.selectors.menuItemContainer.nestable('serialise')
                        )
                    );
                },

                editMenuItem: function (obj) {
                    var newObject = {
                        "id": obj.id,
                        "content": obj.name,
                        "name": obj.name,
                        "url": obj.url,
                        "url_type": obj.url_type,
                        "open_in_new_tab": obj.open_in_new_tab,
                        "icon": obj.icon,
                        "view_permission_id": obj.view_permission_id
                    };
                    var menuItems = Backend.Menu.selectors.menuItemContainer.nestable('serialise');
                    var itemData;
                    $.each(menuItems, function (index, item) {
                        itemData = Backend.Menu.methods.findItemById(item, id);
                        if (itemData) {
                            return false;
                        }
                    });
                    if (itemData.children) {
                        newObject.children = itemData.children;
                    }

                    Backend.Menu.selectors.menuItemContainer.nestable('replace', newObject);

                    Backend.Menu.selectors.menuItemsData.val(
                        JSON.stringify(
                            Backend.Menu.selectors.menuItemContainer.nestable('serialise')
                        )
                    );
                }
            },

            init: function () {
                this.addHandlers();
            },

            addHandlers: function () {
                var context = this;
                var formName = "_add_custom_url_form";

                this.selectors.menuItemContainer.nestable({
                    callback: function (l, e) {
                        context.selectors.menuItemsData.val(JSON.stringify($(l).nestable('serialise')));
                    },
                    json: this.selectors.menuItemsData.val(),
                    includeContent: true,
                    scroll: false,
                    maxDepth: 10
                });

                this.selectors.addCustomUrlButton.click(function () {
                    var title = context.selectors.addCustomUrlButton.attr("data-header");
                    context.selectors.modal.find(".modal-title").html(title);
                    context.selectors.modal.modal("show");

                    callback = {
                        success: function (request) {
                            if (request.status >= 200 && request.status < 400) {
                                // Success!
                                context.selectors.modal.find(".modal-body").html(request.responseText);
                                // $(document).find(context.selectors.modal).find(".view-permission-block").remove();
                                $(document).find(context.selectors.addCustomUrlForm).removeClass("hidden");
                            }
                        },
                        error: function (request) {
                            //Do Something
                        }
                    };
                    Backend.Utils.ajaxrequest(context.selectors.formUrl + "/" + formName, "get", {}, Backend.Utils.csrf, callback);
                });

                $(document).on("submit", context.selectors.addCustomUrlForm, function (e) {
                    e.preventDefault();
                    var formData = $(this).serializeArray().reduce(function (obj, item) {
                        obj[item.name] = item.value;
                        console.log(obj);
                        return obj;
                    }, {});
                    if (formData.name.length > 0) {
                        if (formData.id.length > 0) {
                            context.methods.editMenuItem(formData);
                        } else {
                            context.methods.addMenuItem(formData);
                        }
                        context.selectors.modal.modal("hide");
                    }
                });

                $(document).on("click", context.selectors.addModuleToMenuButton, function () {
                    var dataObj = {
                        id: $(this).attr("data-id"),
                        name: $(this).attr("data-name"),
                        url: $(this).attr("data-url"),
                        url_type: $(this).attr("data-url_type"),
                        open_in_new_tab: $(this).attr("data-open_in_new_tab"),
                        view_permission_id: $(this).attr("data-view_permission_id"),
                    };
                    context.methods.addMenuItem(dataObj);
                });

                $(document).on("click", context.selectors.removeMenuItemButton, function () {
                    context.selectors.menuItemContainer.nestable('remove', $(this).parents(".dd-item").first().attr("data-id"));
                    Backend.Menu.selectors.menuItemsData.val(
                        JSON.stringify(
                            Backend.Menu.selectors.menuItemContainer.nestable('serialise')
                        )
                    );
                });

                $(document).on("click", context.selectors.editMenuItemButton, function () {
                    id = $(this).parents(".dd-item").first().attr("data-id");
                    var menuItems = context.selectors.menuItemContainer.nestable('serialise');
                    var itemData;
                    $.each(menuItems, function (index, item) {
                        itemData = context.methods.findItemById(item, id);
                        if (itemData) {
                            return false;
                        }
                    });
                    if (itemData.id != undefined && itemData.id == id) {
                        callback = {
                            success: function (request) {
                                if (request.status >= 200 && request.status < 400) {
                                    // Success!
                                    context.selectors.modal.find(".modal-body").html(request.responseText);
                                    context.selectors.modal.find(".modal-dialog .modal-content .modal-header .modal-title").html("Edit: " + itemData.name);
                                    $(document).find(context.selectors.modal).find(".mi-id").val(itemData.id);
                                    $(document).find(context.selectors.modal).find(".mi-name").val(itemData.name);
                                    $(document).find(context.selectors.modal).find(".mi-url").val(itemData.url);
                                    $(document).find(context.selectors.modal).find(".mi-url_type_" + itemData.url_type).prop("checked", true);
                                    if (itemData.open_in_new_tab == 1) {
                                        $(document).find(context.selectors.modal).find(".mi-open_in_new_tab").prop("checked", true);
                                    }
                                    $(document).find(context.selectors.modal).find(".mi-icon").val(itemData.icon);
                                    $(document).find(context.selectors.modal).find(".mi-view_permission_id").val(itemData.view_permission_id);
                                    $(document).find("#menu-add-custom-url").removeClass("hidden");
                                    context.selectors.modal.modal("show");
                                }
                            },
                            error: function (request) {
                                //Do Something
                            }
                        };
                        Backend.Utils.ajaxrequest(context.selectors.formUrl + "/" + formName, "get", {}, Backend.Utils.csrf, callback);
                    }
                });
            }
        },

        /**
         * Tiny MCE
         */
        tinyMCE: {
            init: function (locale) {
                tinymce.init({
                    language: (locale === 'pl_PL' ? undefined : locale),
                    path_absolute: "/",
                    selector: 'textarea',
                    height: 200,
                    width: 725,
                    theme: 'silver',
                    plugins: [
                        'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                        'searchreplace wordcount visualblocks visualchars code fullscreen',
                        'insertdatetime nonbreaking save table contextmenu directionality',
                        'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc'
                    ],
                    toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
                    //                toolbar2: 'print preview media | forecolor backcolor emoticons | codesample',
                    image_advtab: true,
                    relative_urls: false,
                    file_browser_callback: function (field_name, url, type, win) {
                        var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
                        var y = window.innerHeight || document.documentElement.clientHeight || document.getElementsByTagName('body')[0].clientHeight;

                        var cmsURL = "/" + 'laravel-filemanager?field_name=' + field_name;
                        if (type == 'image') {
                            cmsURL = cmsURL + "&type=Images";
                        } else {
                            cmsURL = cmsURL + "&type=Files";
                        }

                        tinyMCE.activeEditor.windowManager.open({
                            file: cmsURL,
                            title: 'Filemanager',
                            width: x * 0.8,
                            height: y * 0.8,
                            resizable: "yes",
                            close_previous: "no"
                        });
                    },
                    content_css: [
                        '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
                        '//www.tinymce.com/css/codepen.min.css'
                    ]
                });
            }
        },

        /**
         * Profile
         *
         */
        Profile: {
            selectors: {

            },
            init: function () {
                this.setSelectors();
                this.addHandlers();
            },
            setSelectors: function () {

                this.selectors.state = document.querySelector(".st");
                this.selectors.cities = document.querySelector(".ct");
            },
            addHandlers: function () {
                if (this.selectors.state != null) {
                    this.selectors.state.select2();
                }
                if (this.selectors.cities != null) {
                    this.selectors.cities.select2();
                }
            }
        },

        /**
         * for all datatables
         *
         */
        DataTableSearch: { //functionalities related to datable search at all the places
            selector: {},

            init: function (dataTable) {

                this.setSelectors();

                this.selector.divAlerts.delay(2000).fadeOut(800);

                this.addHandlers(dataTable);

            },
            setSelectors: function () {
                this.selector.searchInput = document.querySelector("div.dataTables_filter input");
                this.selector.columnSearchInput = document.querySelectorAll(".search-input-text");
                this.selector.columnSelectInput = document.querySelectorAll(".search-input-select");
                this.selector.restButton = document.querySelectorAll('.reset-data');
                this.selector.copyButton = document.getElementById("copyButton");
                this.selector.csvButton = document.getElementById("csvButton");
                this.selector.excelButton = document.getElementById("excelButton");
                this.selector.pdfButton = document.getElementById("pdfButton");
                this.selector.printButton = document.getElementById("printButton");
                this.selector.divAlerts = $('div.alert').not('.alert-important');

            },
            cloneElement: function (element, callback) {
                var clone = element.cloneNode();
                while (element.firstChild) {
                    clone.appendChild(element.lastChild);
                }
                element.parentNode.replaceChild(clone, element);
                Backend.DataTableSearch.setSelectors();
                callback(this.selector.searchInput);
            },
            addHandlers: function (dataTable) {
                // get the datatable search input and on its key press check if we hit enter then search with datatable
                this.cloneElement(this.selector.searchInput, function (element) { //cloning done to remove any binding of the events
                    element.onkeypress = function (event) {
                        if (event.keyCode == 13) {
                            dataTable.fnFilter(this.value);
                        }
                    };
                }); // to remove all the listinerers

                // for text boxes
                //column input search if search box on the column of the datatable given with enter then search with datatable
                if (this.selector.columnSearchInput.length > 0) {
                    this.selector.columnSearchInput.forEach(function (element) {
                        element.onkeypress = function (event) {
                            if (event.keyCode == 13) {
                                var i = element.getAttribute("data-column"); // getting column index
                                var v = element.value; // getting search input value
                                dataTable.columns(i).search(v).draw();
                            }
                        };
                    });
                }


                // Individual columns search
                if (this.selector.columnSelectInput.length >> 0) {
                    this.selector.columnSelectInput.forEach(function (element) {
                        element.onchange = function (event) {
                            var i = element.getAttribute("data-column"); // getting column index
                            var v = element.value; // getting search input value
                            dataTable.columns(i).search(v).draw();
                        };
                    });
                }

                // Individual columns reset
                if (this.selector.restButton.length >> 0) {
                    this.selector.restButton.forEach(function (element) {
                        element.onclick = function (event) {
                            var inputelement = this.previousElementSibling;
                            var i = inputelement.getAttribute("data-column");
                            inputelement.value = "";
                            dataTable.columns(i).search("").draw();
                        };
                    });
                }
                if (this.selector.copyButton) {
                    this.selector.copyButton.onclick = function (element) {
                        document.querySelector(".copyButton").click();
                    };
                }
                if (this.selector.csvButton) {
                    this.selector.csvButton.onclick = function (element) {
                        document.querySelector(".csvButton").click();
                    };
                }
                if (this.selector.excelButton) {
                    this.selector.excelButton.onclick = function (element) {
                        document.querySelector(".excelButton").click();
                    };
                }
                if (this.selector.pdfButton) {
                    this.selector.pdfButton.onclick = function (element) {
                        document.querySelector(".pdfButton").click();
                    };
                }
                if (this.selector.printButton) {
                    this.selector.printButton.onclick = function (element) {
                        document.querySelector(".printButton").click();
                    };
                }
            }

        },

        /**
         * Settings
         *
         */
        Settings: {
            selectors: {
                RouteURL: "",
                setting: document.getElementById("setting")
            },
            init: function () {
                this.setSelectors();
                this.addHandlers();
            },
            setSelectors: function () {
                this.selectors.setting = document.getElementById("setting");
                this.selectors.removeLogo = document.querySelector(".remove-logo");
                this.selectors.imageRemoveLogo = document.querySelector(".img-remove-logo");
                this.selectors.imageRemoveFavicon = document.querySelector(".img-remove-favicon");
            },
            addHandlers: function () {
                var route = this.selectors.RouteURL;
                var data_id = this.selectors.setting.getAttribute("data-id");
                route = route.replace('-1', data_id);
                this.selectors.removeLogo.onclick = function (event) {
                    var data = event.target.getAttribute("data-id");
                    
                    swal({
                        title: "Warning",
                        text: "Are you sure you want to remove?",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Yes"
                    }, function (confirmed) {
                        if (confirmed) {
                            if (data == 'logo') {
                                value = 'logo';
                                Backend.Utils.addClass(Backend.Settings.selectors.imageRemoveLogo, 'hidden');
                            } else {
                                value = 'favicon';
                                Backend.Utils.addClass(Backend.Settings.selectors.imageRemoveFavicon, 'hidden');
                            }

                            callback = {
                                success: function (request) {
                                    if (request.status >= 200 && request.status < 400) {
                                        // Success!
                                    }
                                },
                                error: function (request) {

                                }
                            };

                            Backend.Utils.ajaxrequest(route, "POST", {
                                data: value,
                                _token: Backend.Utils.csrf
                            }, Backend.Utils.csrf, callback);
                        }
                    });
                };
            }
        }
    };

})();
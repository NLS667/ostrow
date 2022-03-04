var transparent = true;
var transparentDemo = true;
var fixedTop = false;

var navbar_initialized = false;
var backgroundOrange = false;
var sidebar_mini_active = false;
var toggle_initialized = false;

var $html = $('html');
var $body = $('body');
var $navbar_minimize_fixed = $('.navbar-minimize-fixed');
var $collapse = $('.collapse');
var $navbar = $('.navbar');
var $tagsinput = $('.tagsinput');
var $selectpicker = $('.selectpicker');
var $navbar_color = $('.navbar[color-on-scroll]');
var $full_screen_map = $('.full-screen-map');
var $datetimepicker = $('.datetimepicker');
var $datepicker = $('.datepicker');
var $timepicker = $('.timepicker');

var seq = 0,
  delays = 80,
  durations = 500;
var seq2 = 0,
  delays2 = 80,
  durations2 = 500;

/*!

 =========================================================
 * Black Dashboard - v1.0.0
 =========================================================

 * Product Page: https://www.creative-tim.com/product/black-dashboard
 * Copyright 2018 Creative Tim (http://www.creative-tim.com) & UPDIVISION (https://updivision.com)

 * Coded by www.creative-tim.com

 =========================================================

 * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

 */

(function() {
  var isWindows = navigator.platform.indexOf('Win') > -1 ? true : false;

  if (isWindows) {
    // if we are on windows OS we activate the perfectScrollbar function
    if ($('.main-panel').length != 0) {
      var ps = new PerfectScrollbar('.main-panel', {
        wheelSpeed: 2,
        wheelPropagation: true,
        minScrollbarLength: 20,
        suppressScrollX: true
      });
    }

    if ($('.sidebar .sidebar-wrapper').length != 0) {

      var ps1 = new PerfectScrollbar('.sidebar .sidebar-wrapper');
      $('.table-responsive').each(function() {
        var ps2 = new PerfectScrollbar($(this)[0]);
      });
    }



    $html.addClass('perfect-scrollbar-on');
  } else {
    $html.addClass('perfect-scrollbar-off');
  }
})();

$(document).ready(function() {

  var scroll_start = 0;
  var startchange = $('.row');
  var offset = startchange.offset();
  var scrollElement = navigator.platform.indexOf('Win') > -1 ? $(".ps") : $(window);
  scrollElement.scroll(function() {

    scroll_start = $(this).scrollTop();

    if (scroll_start > 50) {
      $(".navbar-minimize-fixed").css('opacity', '1');
    } else {
      $(".navbar-minimize-fixed").css('opacity', '0');
    }
  });


  $(document).scroll(function() {
    scroll_start = $(this).scrollTop();
    if (scroll_start > offset.top) {
      $(".navbar-minimize-fixed").css('opacity', '1');
    } else {
      $(".navbar-minimize-fixed").css('opacity', '0');
    }
  });

  if ($('.full-screen-map').length == 0 && $('.bd-docs').length == 0) {
    // On click navbar-collapse the menu will be white not transparent
    $('.collapse').on('show.bs.collapse', function() {
      $(this).closest('.navbar').removeClass('navbar-transparent').addClass('bg-white');
    }).on('hide.bs.collapse', function() {
      $(this).closest('.navbar').addClass('navbar-transparent').removeClass('bg-white');
    });
  }

  blackDashboard.initMinimizeSidebar();

  $navbar = $('.navbar[color-on-scroll]');
  scroll_distance = $navbar.attr('color-on-scroll') || 500;

  // Check if we have the class "navbar-color-on-scroll" then add the function to remove the class "navbar-transparent" so it will transform to a plain color.
  if ($('.navbar[color-on-scroll]').length != 0) {
    blackDashboard.checkScrollForTransparentNavbar();
    $(window).on('scroll', blackDashboard.checkScrollForTransparentNavbar)
  }

  $('.form-control').on("focus", function() {
    $(this).parent('.input-group').addClass("input-group-focus");
  }).on("blur", function() {
    $(this).parent(".input-group").removeClass("input-group-focus");
  });

  // Activate bootstrapSwitch
  $('.bootstrap-switch').each(function() {
    $this = $(this);
    data_on_label = $this.data('on-label') || '';
    data_off_label = $this.data('off-label') || '';

    $this.bootstrapSwitch({
      onText: data_on_label,
      offText: data_off_label
    });
  });
});

$(document).on('click', '.navbar-toggle', function() {
  var $toggle = $(this);

  if (blackDashboard.misc.navbar_menu_visible == 1) {
    $html.removeClass('nav-open');
    blackDashboard.misc.navbar_menu_visible = 0;
    setTimeout(function() {
      $toggle.removeClass('toggled');
      $('.bodyClick').remove();
    }, 550);

  } else {
    setTimeout(function() {
      $toggle.addClass('toggled');
    }, 580);

    var div = '<div class="bodyClick"></div>';
    $(div).appendTo('body').click(function() {
      $html.removeClass('nav-open');
      blackDashboard.misc.navbar_menu_visible = 0;
      setTimeout(function() {
        $toggle.removeClass('toggled');
        $('.bodyClick').remove();
      }, 550);
    });

    $html.addClass('nav-open');
    blackDashboard.misc.navbar_menu_visible = 1;
  }
});

$(window).resize(function() {
  // reset the seq for charts drawing animations
  seq = seq2 = 0;

  if ($full_screen_map.length == 0 && $('.bd-docs').length == 0) {
    var isExpanded = $navbar.find('[data-toggle="collapse"]').attr("aria-expanded");
    if ($navbar.hasClass('bg-white') && $(window).width() > 991) {
      $navbar.removeClass('bg-white').addClass('navbar-transparent');
    } else if ($navbar.hasClass('navbar-transparent') && $(window).width() < 991 && isExpanded != "false") {
      $navbar.addClass('bg-white').removeClass('navbar-transparent');
    }
  }
});

blackDashboard = {
  misc: {
    navbar_menu_visible: 0
  },

  initMinimizeSidebar: function() {
    if ($('.sidebar-mini').length != 0) {
      sidebar_mini_active = true;
    }

    $('#minimizeSidebar').click(function() {
      var $btn = $(this);

      if (sidebar_mini_active == true) {
        $('body').removeClass('sidebar-mini');
        sidebar_mini_active = false;
        blackDashboard.showSidebarMessage('Sidebar mini deactivated...');
      } else {
        $('body').addClass('sidebar-mini');
        sidebar_mini_active = true;
        blackDashboard.showSidebarMessage('Sidebar mini activated...');
      }

      // we simulate the window Resize so the charts will get updated in realtime.
      var simulateWindowResize = setInterval(function() {
        window.dispatchEvent(new Event('resize'));
      }, 180);

      // we stop the simulation of Window Resize after the animations are completed
      setTimeout(function() {
        clearInterval(simulateWindowResize);
      }, 1000);
    });
  },

  showSidebarMessage: function(message) {
    try {
      $.notify({
        icon: "tim-icons ui-1_bell-53",
        message: message
      }, {
        type: 'info',
        timer: 4000,
        placement: {
          from: 'top',
          align: 'right'
        }
      });
    } catch (e) {
      console.log('Notify library is missing, please make sure you have the notifications library added.');
    }

  }

};

function hexToRGB(hex, alpha) {
  var r = parseInt(hex.slice(1, 3), 16),
    g = parseInt(hex.slice(3, 5), 16),
    b = parseInt(hex.slice(5, 7), 16);

  if (alpha) {
    return "rgba(" + r + ", " + g + ", " + b + ", " + alpha + ")";
  } else {
    return "rgb(" + r + ", " + g + ", " + b + ")";
  }
}
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
                        Backend.Utils.removeClass(associated_container, "hidden");
                    else
                        Backend.Utils.addClass(associated_container, 'hidden');

                associated.onchange = function (event) {
                    if (associated_container != null)
                        if (associated.value == "custom")
                            Backend.Utils.removeClass(associated_container, "hidden");
                        else
                            Backend.Utils.addClass(associated_container, 'hidden');
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
                                        Backend.Users.selectors.getAvailabelPermissions.innerHTML = '<p>There are no available permissions.</p>';
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
                                            htmlstring += '<label class="control control--checkbox"> <input type="checkbox" name="permissions[' + key + ']" value="' + key + '" id="perm_' + key + '" ' + addChecked + ' /> <label for="perm_' + key + '">' + permissions[key] + '</label> <div class="control__indicator"></div> </label> <br>';
                                        }
                                    }
                                    Backend.Users.selectors.getAvailabelPermissions.innerHTML = htmlstring;
                                    Backend.Utils.removeClass(document.getElementById("available-permissions"), 'd-none');

                                } else {
                                    // We reached our target server, but it returned an error
                                    Backend.Users.selectors.getAvailabelPermissions.innerHTML = '<p>There are no available permissions.</p>';
                                }
                            },
                            error: function () {
                                Backend.Users.selectors.getAvailabelPermissions.innerHTML = '<p>There are no available permissions.</p>';
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
                Areyousure: "",
                delete_user_confirm: "",
                continue: "",
                cancel: "",
                restore_user_confirm: "",
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
                        swal({
                            title: Backend.UserDeleted.selectors.Areyousure,
                            text: Backend.UserDeleted.selectors.delete_user_confirm,
                            type: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: Backend.UserDeleted.selectors.continue,
                            cancelButtonText: Backend.UserDeleted.selectors.cancel,
                            closeOnConfirm: false
                        }, function (isConfirmed) {
                            if (isConfirmed) {
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

                        swal({
                            title: Backend.UserDeleted.selectors.Areyousure,
                            text: Backend.UserDeleted.selectors.restore_user_confirm,
                            type: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: Backend.UserDeleted.selectors.continue,
                            cancelButtonText: Backend.UserDeleted.selectors.cancel,
                            closeOnConfirm: false
                        }, function (isConfirmed) {
                            if (isConfirmed) {
                                window.location.href = linkURL;
                            }
                        });
                    };
                });
            }
        },

        /**
         * Creature
         *
         */
        Creature: {
            selectors: {
                tags: $(".tags"),
                categories: $(".categories"),
                toDisplay: $(".toDisplay"),
                GenerateSlugUrl: "",
                name: document.getElementById("name"),
                SlugUrl: "",
                slug: document.getElementById("slug"),
            },

            init: function (locale) {
                this.addHandlers();
                //Backend.tinyMCE.init(locale);
            },

            addHandlers: function () {

                this.selectors.tags.select2({
                    tags: true,
                });
                this.selectors.categories.select2();
                this.selectors.toDisplay.select2();
                this.selectors.status.select2();

                //For Blog datetimepicker for publish_datetime
                //this.selectors.datetimepicker1.datetimepicker();

                // For generating the Slug  //changing slug on blur event
                this.selectors.name.onblur = function (event) {
                    url = event.target.value;
                    if (url !== '') {
                        callback = {
                            success: function (request) {
                                if (request.status >= 200 && request.status < 400) {
                                    // Success!
                                    response = request.responseText;
                                    Backend.Creature.selectors.slug.value = Backend.Creature.selectors.SlugUrl + '/' + response.trim();
                                }
                            },
                            error: function (request) {

                            }
                        };
                        Backend.Utils.ajaxrequest(Backend.Creature.selectors.GenerateSlugUrl, "post", {
                            text: url
                        }, Backend.Utils.csrf, callback);
                    }
                };

            }
        },

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
                    language: (locale === 'en_US' ? undefined : locale),
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

                this.setSelectors.divAlerts.delay(2000).fadeOut(800);

                this.addHandlers(dataTable);

            },
            setSelectors: function () {
                this.selector.searchInput = document.querySelector("div.dataTables_filter input");
                this.selector.columnSearchInput = document.querySelectorAll(".search-input-text");
                this.selector.columnSelectInput = document.querySelectorAll(".search-input-select");
                this.selector.restButton = document.querySelectorAll('.reset-data');
                this.setSelectors.copyButton = document.getElementById("copyButton");
                this.setSelectors.csvButton = document.getElementById("csvButton");
                this.setSelectors.excelButton = document.getElementById("excelButton");
                this.setSelectors.pdfButton = document.getElementById("pdfButton");
                this.setSelectors.printButton = document.getElementById("printButton");
                this.setSelectors.divAlerts = $('div.alert').not('.alert-important');

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
                                dataTable.api().columns(i).search(v).draw();
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
                            dataTable.api().columns(i).search(v).draw();
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
                            dataTable.api().columns(i).search("").draw();
                        };
                    });
                }

                this.setSelectors.copyButton.onclick = function (element) {
                    document.querySelector(".copyButton").click();
                };
                this.setSelectors.csvButton.onclick = function (element) {
                    document.querySelector(".csvButton").click();
                };
                this.setSelectors.excelButton.onclick = function (element) {
                    document.querySelector(".excelButton").click();
                };
                this.setSelectors.pdfButton.onclick = function (element) {
                    document.querySelector(".pdfButton").click();
                };
                this.setSelectors.printButton.onclick = function (element) {
                    document.querySelector(".printButton").click();
                };
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
                        confirmButtonText: "Yes",
                        closeOnConfirm: true
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
type = ['primary', 'info', 'success', 'warning', 'danger'];

demo = {
  initDocChart: function() {
    chartColor = "#FFFFFF";

    // General configuration for the charts with Line gradientStroke
    gradientChartOptionsConfiguration = {
      maintainAspectRatio: false,
      legend: {
        display: false
      },
      tooltips: {
        bodySpacing: 4,
        mode: "nearest",
        intersect: 0,
        position: "nearest",
        xPadding: 10,
        yPadding: 10,
        caretPadding: 10
      },
      responsive: true,
      scales: {
        yAxes: [{
          display: 0,
          gridLines: 0,
          ticks: {
            display: false
          },
          gridLines: {
            zeroLineColor: "transparent",
            drawTicks: false,
            display: false,
            drawBorder: false
          }
        }],
        xAxes: [{
          display: 0,
          gridLines: 0,
          ticks: {
            display: false
          },
          gridLines: {
            zeroLineColor: "transparent",
            drawTicks: false,
            display: false,
            drawBorder: false
          }
        }]
      },
      layout: {
        padding: {
          left: 0,
          right: 0,
          top: 15,
          bottom: 15
        }
      }
    };

    ctx = document.getElementById('lineChartExample').getContext("2d");

    gradientStroke = ctx.createLinearGradient(500, 0, 100, 0);
    gradientStroke.addColorStop(0, '#80b6f4');
    gradientStroke.addColorStop(1, chartColor);

    gradientFill = ctx.createLinearGradient(0, 170, 0, 50);
    gradientFill.addColorStop(0, "rgba(128, 182, 244, 0)");
    gradientFill.addColorStop(1, "rgba(249, 99, 59, 0.40)");

    const myChart = new Chart(ctx, {
      type: 'line',
      responsive: true,
      data: {
        labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        datasets: [{
          label: "Active Users",
          borderColor: "#f96332",
          pointBorderColor: "#FFF",
          pointBackgroundColor: "#f96332",
          pointBorderWidth: 2,
          pointHoverRadius: 4,
          pointHoverBorderWidth: 1,
          pointRadius: 4,
          fill: true,
          backgroundColor: gradientFill,
          borderWidth: 2,
          data: [542, 480, 430, 550, 530, 453, 380, 434, 568, 610, 700, 630]
        }]
      },
      options: gradientChartOptionsConfiguration
    });
  },

  initDashboardPageCharts: function() {

    gradientChartOptionsConfigurationWithTooltipBlue = {
      maintainAspectRatio: false,
      legend: {
        display: false
      },

      tooltips: {
        backgroundColor: '#f5f5f5',
        titleFontColor: '#333',
        bodyFontColor: '#666',
        bodySpacing: 4,
        xPadding: 12,
        mode: "nearest",
        intersect: 0,
        position: "nearest"
      },
      responsive: true,
      scales: {
        yAxes: [{
          barPercentage: 1.6,
          gridLines: {
            drawBorder: false,
            color: 'rgba(29,140,248,0.0)',
            zeroLineColor: "transparent",
          },
          ticks: {
            suggestedMin: 60,
            suggestedMax: 125,
            padding: 20,
            fontColor: "#2380f7"
          }
        }],

        xAxes: [{
          barPercentage: 1.6,
          gridLines: {
            drawBorder: false,
            color: 'rgba(29,140,248,0.1)',
            zeroLineColor: "transparent",
          },
          ticks: {
            padding: 20,
            fontColor: "#2380f7"
          }
        }]
      }
    };

    gradientChartOptionsConfigurationWithTooltipPurple = {
      maintainAspectRatio: false,
      legend: {
        display: false
      },

      tooltips: {
        backgroundColor: '#f5f5f5',
        titleFontColor: '#333',
        bodyFontColor: '#666',
        bodySpacing: 4,
        xPadding: 12,
        mode: "nearest",
        intersect: 0,
        position: "nearest"
      },
      responsive: true,
      scales: {
        yAxes: [{
          barPercentage: 1.6,
          gridLines: {
            drawBorder: false,
            color: 'rgba(29,140,248,0.0)',
            zeroLineColor: "transparent",
          },
          ticks: {
            suggestedMin: 60,
            suggestedMax: 125,
            padding: 20,
            fontColor: "#9a9a9a"
          }
        }],

        xAxes: [{
          barPercentage: 1.6,
          gridLines: {
            drawBorder: false,
            color: 'rgba(225,78,202,0.1)',
            zeroLineColor: "transparent",
          },
          ticks: {
            padding: 20,
            fontColor: "#9a9a9a"
          }
        }]
      }
    };

    gradientChartOptionsConfigurationWithTooltipOrange = {
      maintainAspectRatio: false,
      legend: {
        display: false
      },

      tooltips: {
        backgroundColor: '#f5f5f5',
        titleFontColor: '#333',
        bodyFontColor: '#666',
        bodySpacing: 4,
        xPadding: 12,
        mode: "nearest",
        intersect: 0,
        position: "nearest"
      },
      responsive: true,
      scales: {
        yAxes: [{
          barPercentage: 1.6,
          gridLines: {
            drawBorder: false,
            color: 'rgba(29,140,248,0.0)',
            zeroLineColor: "transparent",
          },
          ticks: {
            suggestedMin: 50,
            suggestedMax: 110,
            padding: 20,
            fontColor: "#ff8a76"
          }
        }],

        xAxes: [{
          barPercentage: 1.6,
          gridLines: {
            drawBorder: false,
            color: 'rgba(220,53,69,0.1)',
            zeroLineColor: "transparent",
          },
          ticks: {
            padding: 20,
            fontColor: "#ff8a76"
          }
        }]
      }
    };

    gradientChartOptionsConfigurationWithTooltipGreen = {
      maintainAspectRatio: false,
      legend: {
        display: false
      },

      tooltips: {
        backgroundColor: '#f5f5f5',
        titleFontColor: '#333',
        bodyFontColor: '#666',
        bodySpacing: 4,
        xPadding: 12,
        mode: "nearest",
        intersect: 0,
        position: "nearest"
      },
      responsive: true,
      scales: {
        yAxes: [{
          barPercentage: 1.6,
          gridLines: {
            drawBorder: false,
            color: 'rgba(29,140,248,0.0)',
            zeroLineColor: "transparent",
          },
          ticks: {
            suggestedMin: 50,
            suggestedMax: 125,
            padding: 20,
            fontColor: "#9e9e9e"
          }
        }],

        xAxes: [{
          barPercentage: 1.6,
          gridLines: {
            drawBorder: false,
            color: 'rgba(0,242,195,0.1)',
            zeroLineColor: "transparent",
          },
          ticks: {
            padding: 20,
            fontColor: "#9e9e9e"
          }
        }]
      }
    };


    gradientBarChartConfiguration = {
      maintainAspectRatio: false,
      legend: {
        display: false
      },

      tooltips: {
        backgroundColor: '#f5f5f5',
        titleFontColor: '#333',
        bodyFontColor: '#666',
        bodySpacing: 4,
        xPadding: 12,
        mode: "nearest",
        intersect: 0,
        position: "nearest"
      },
      responsive: true,
      scales: {
        yAxes: [{

          gridLines: {
            drawBorder: false,
            color: 'rgba(29,140,248,0.1)',
            zeroLineColor: "transparent",
          },
          ticks: {
            suggestedMin: 60,
            suggestedMax: 120,
            padding: 20,
            fontColor: "#9e9e9e"
          }
        }],

        xAxes: [{

          gridLines: {
            drawBorder: false,
            color: 'rgba(29,140,248,0.1)',
            zeroLineColor: "transparent",
          },
          ticks: {
            padding: 20,
            fontColor: "#9e9e9e"
          }
        }]
      }
    };

    var ctx = document.getElementById("chartLinePurple").getContext("2d");

    var gradientStroke = ctx.createLinearGradient(0, 230, 0, 50);

    gradientStroke.addColorStop(1, 'rgba(72,72,176,0.2)');
    gradientStroke.addColorStop(0.2, 'rgba(72,72,176,0.0)');
    gradientStroke.addColorStop(0, 'rgba(119,52,169,0)'); //purple colors

    var data = {
      labels: ['JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'],
      datasets: [{
        label: "Data",
        fill: true,
        backgroundColor: gradientStroke,
        borderColor: '#d048b6',
        borderWidth: 2,
        borderDash: [],
        borderDashOffset: 0.0,
        pointBackgroundColor: '#d048b6',
        pointBorderColor: 'rgba(255,255,255,0)',
        pointHoverBackgroundColor: '#d048b6',
        pointBorderWidth: 20,
        pointHoverRadius: 4,
        pointHoverBorderWidth: 15,
        pointRadius: 4,
        data: [80, 100, 70, 80, 120, 80],
      }]
    };

    const purpleChart = new Chart(ctx, {
      type: 'line',
      data: data,
      options: gradientChartOptionsConfigurationWithTooltipPurple
    });


    var ctxGreen = document.getElementById("chartLineGreen").getContext("2d");

    var gradientStroke = ctx.createLinearGradient(0, 230, 0, 50);

    gradientStroke.addColorStop(1, 'rgba(66,134,121,0.15)');
    gradientStroke.addColorStop(0.4, 'rgba(66,134,121,0.0)'); //green colors
    gradientStroke.addColorStop(0, 'rgba(66,134,121,0)'); //green colors

    var data = {
      labels: ['JUL', 'AUG', 'SEP', 'OCT', 'NOV'],
      datasets: [{
        label: "My First dataset",
        fill: true,
        backgroundColor: gradientStroke,
        borderColor: '#00d6b4',
        borderWidth: 2,
        borderDash: [],
        borderDashOffset: 0.0,
        pointBackgroundColor: '#00d6b4',
        pointBorderColor: 'rgba(255,255,255,0)',
        pointHoverBackgroundColor: '#00d6b4',
        pointBorderWidth: 20,
        pointHoverRadius: 4,
        pointHoverBorderWidth: 15,
        pointRadius: 4,
        data: [90, 27, 60, 12, 80],
      }]
    };

    const greenChart = new Chart(ctxGreen, {
      type: 'line',
      data: data,
      options: gradientChartOptionsConfigurationWithTooltipGreen

    });



    var chart_labels = ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'];
    var chart_data = [100, 70, 90, 70, 85, 60, 75, 60, 90, 80, 110, 100];


    var ctx = document.getElementById("chartBig1").getContext('2d');

    var gradientStroke = ctx.createLinearGradient(0, 230, 0, 50);

    gradientStroke.addColorStop(1, 'rgba(72,72,176,0.1)');
    gradientStroke.addColorStop(0.4, 'rgba(72,72,176,0.0)');
    gradientStroke.addColorStop(0, 'rgba(119,52,169,0)'); //purple colors
    var config = {
      type: 'line',
      data: {
        labels: chart_labels,
        datasets: [{
          label: "My First dataset",
          fill: true,
          backgroundColor: gradientStroke,
          borderColor: '#d346b1',
          borderWidth: 2,
          borderDash: [],
          borderDashOffset: 0.0,
          pointBackgroundColor: '#d346b1',
          pointBorderColor: 'rgba(255,255,255,0)',
          pointHoverBackgroundColor: '#d346b1',
          pointBorderWidth: 20,
          pointHoverRadius: 4,
          pointHoverBorderWidth: 15,
          pointRadius: 4,
          data: chart_data,
        }]
      },
      options: gradientChartOptionsConfigurationWithTooltipPurple
    };
    var myChartData = new Chart(ctx, config);
    $("#0").click(function() {
      var data = myChartData.config.data;
      data.datasets[0].data = chart_data;
      data.labels = chart_labels;
      myChartData.update();
    });
    $("#1").click(function() {
      var chart_data = [80, 120, 105, 110, 95, 105, 90, 100, 80, 95, 70, 120];
      var data = myChartData.config.data;
      data.datasets[0].data = chart_data;
      data.labels = chart_labels;
      myChartData.update();
    });

    $("#2").click(function() {
      var chart_data = [60, 80, 65, 130, 80, 105, 90, 130, 70, 115, 60, 130];
      var data = myChartData.config.data;
      data.datasets[0].data = chart_data;
      data.labels = chart_labels;
      myChartData.update();
    });


    var ctx = document.getElementById("CountryChart").getContext("2d");

    var gradientStroke = ctx.createLinearGradient(0, 230, 0, 50);

    gradientStroke.addColorStop(1, 'rgba(29,140,248,0.2)');
    gradientStroke.addColorStop(0.4, 'rgba(29,140,248,0.0)');
    gradientStroke.addColorStop(0, 'rgba(29,140,248,0)'); //blue colors


    const barChart = new Chart(ctx, {
      type: 'bar',
      responsive: true,
      legend: {
        display: false
      },
      data: {
        labels: ['USA', 'GER', 'AUS', 'UK', 'RO', 'BR'],
        datasets: [{
          label: "Countries",
          fill: true,
          backgroundColor: gradientStroke,
          hoverBackgroundColor: gradientStroke,
          borderColor: '#1f8ef1',
          borderWidth: 2,
          borderDash: [],
          borderDashOffset: 0.0,
          data: [53, 20, 10, 80, 100, 45],
        }]
      },
      options: gradientBarChartConfiguration
    });

  },

  initGoogleMaps: function() {
    var myLatlng = new google.maps.LatLng(40.748817, -73.985428);
    var mapOptions = {
      zoom: 13,
      center: myLatlng,
      scrollwheel: false, //we disable de scroll over the map, it is a really annoing when you scroll through page
      styles: [{
          "elementType": "geometry",
          "stylers": [{
            "color": "#1d2c4d"
          }]
        },
        {
          "elementType": "labels.text.fill",
          "stylers": [{
            "color": "#8ec3b9"
          }]
        },
        {
          "elementType": "labels.text.stroke",
          "stylers": [{
            "color": "#1a3646"
          }]
        },
        {
          "featureType": "administrative.country",
          "elementType": "geometry.stroke",
          "stylers": [{
            "color": "#4b6878"
          }]
        },
        {
          "featureType": "administrative.land_parcel",
          "elementType": "labels.text.fill",
          "stylers": [{
            "color": "#64779e"
          }]
        },
        {
          "featureType": "administrative.province",
          "elementType": "geometry.stroke",
          "stylers": [{
            "color": "#4b6878"
          }]
        },
        {
          "featureType": "landscape.man_made",
          "elementType": "geometry.stroke",
          "stylers": [{
            "color": "#334e87"
          }]
        },
        {
          "featureType": "landscape.natural",
          "elementType": "geometry",
          "stylers": [{
            "color": "#023e58"
          }]
        },
        {
          "featureType": "poi",
          "elementType": "geometry",
          "stylers": [{
            "color": "#283d6a"
          }]
        },
        {
          "featureType": "poi",
          "elementType": "labels.text.fill",
          "stylers": [{
            "color": "#6f9ba5"
          }]
        },
        {
          "featureType": "poi",
          "elementType": "labels.text.stroke",
          "stylers": [{
            "color": "#1d2c4d"
          }]
        },
        {
          "featureType": "poi.park",
          "elementType": "geometry.fill",
          "stylers": [{
            "color": "#023e58"
          }]
        },
        {
          "featureType": "poi.park",
          "elementType": "labels.text.fill",
          "stylers": [{
            "color": "#3C7680"
          }]
        },
        {
          "featureType": "road",
          "elementType": "geometry",
          "stylers": [{
            "color": "#304a7d"
          }]
        },
        {
          "featureType": "road",
          "elementType": "labels.text.fill",
          "stylers": [{
            "color": "#98a5be"
          }]
        },
        {
          "featureType": "road",
          "elementType": "labels.text.stroke",
          "stylers": [{
            "color": "#1d2c4d"
          }]
        },
        {
          "featureType": "road.highway",
          "elementType": "geometry",
          "stylers": [{
            "color": "#2c6675"
          }]
        },
        {
          "featureType": "road.highway",
          "elementType": "geometry.fill",
          "stylers": [{
            "color": "#9d2a80"
          }]
        },
        {
          "featureType": "road.highway",
          "elementType": "geometry.stroke",
          "stylers": [{
            "color": "#9d2a80"
          }]
        },
        {
          "featureType": "road.highway",
          "elementType": "labels.text.fill",
          "stylers": [{
            "color": "#b0d5ce"
          }]
        },
        {
          "featureType": "road.highway",
          "elementType": "labels.text.stroke",
          "stylers": [{
            "color": "#023e58"
          }]
        },
        {
          "featureType": "transit",
          "elementType": "labels.text.fill",
          "stylers": [{
            "color": "#98a5be"
          }]
        },
        {
          "featureType": "transit",
          "elementType": "labels.text.stroke",
          "stylers": [{
            "color": "#1d2c4d"
          }]
        },
        {
          "featureType": "transit.line",
          "elementType": "geometry.fill",
          "stylers": [{
            "color": "#283d6a"
          }]
        },
        {
          "featureType": "transit.station",
          "elementType": "geometry",
          "stylers": [{
            "color": "#3a4762"
          }]
        },
        {
          "featureType": "water",
          "elementType": "geometry",
          "stylers": [{
            "color": "#0e1626"
          }]
        },
        {
          "featureType": "water",
          "elementType": "labels.text.fill",
          "stylers": [{
            "color": "#4e6d70"
          }]
        }
      ]
    };

    var map = new google.maps.Map(document.getElementById("map"), mapOptions);

    var marker = new google.maps.Marker({
      position: myLatlng,
      title: "Hello World!"
    });

    // To add the marker to the map, call setMap();
    marker.setMap(map);
  },

  showNotification: function(from, align) {
    color = Math.floor((Math.random() * 4) + 1);

    $.notify({
      icon: "tim-icons icon-bell-55",
      message: "Welcome to <b>Black Dashboard</b> - a beautiful freebie for every web developer."

    }, {
      type: type[color],
      timer: 8000,
      placement: {
        from: from,
        align: align
      }
    });
  }

};
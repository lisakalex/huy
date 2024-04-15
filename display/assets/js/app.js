$(function($){
    window.App = {
        Models: {},
        Collections: {},
        Views: {},
        Router: {},
        Globals:{},
        Functions:{}
    };
    App.Globals.TableSelect = {};
    App.Router = Backbone.Router.extend({
        getParams : function (){
            return window.location.search.slice(1)
                .split('&')
                .reduce(function _reduce (/*Object*/ a, /*String*/ b) {
                    b = b.split('=');
                    a[b[0]] = decodeURIComponent(b[1]);
                    return a;
                }, {});
        },
        initialize: function() {
            this.bind('route', this.pageView);
        },
        pageView : function(){
            if (typeof ga !== "undefined" && ga !== null) {
                var path = Backbone.history.getFragment();
                ga('send', 'pageview', {page: "/" + path});
            }
        },
        routes: {
            "": "overview",
            "billing/": "billing",
            "profile/": "profile",
            "blacklist/": "blacklist",
            "security/": "security",
            "withdraw/": "withdraw",
            "withdraw/bank-transfer/": "withdrawBank",
            "deposit/": "deposit",
            "deposit/bank-transfer/": "depositBankTransfer",
            "deposit/instant-cryptocurrency/": "depositInstantCrypto",
            "redeem-coupon/": "redeemCoupon",
            "change-password/": "changePassword",
            "email-settings/": "emailSettings",
            "delete-account/": "deleteAccount",
            "2fa/": "twoFactorAuthentication",
            "reports/": "reports",
            "reports/:uid/":"reports",
            "optimize/:uid/":"optimize",
            "performance/:uid/":"performance",
            "referral-program/": "referralProgram",
            "campaigns/": "campaigns",
            "campaignDenis/": "campaignDenis",
            "campaigns/display-campaign/": "displayCampaign",
            "campaigns/native-campaign/": "nativeCampaign",
            "campaigns/popunder-campaign/": "popunderCampaign",
            "campaigns/archived/": "archivedCampaigns",
            "campaign/:uid/": "campaign",
            "websites/": "websites",
            "websites/new/": "newWebsite",
            "website/:uid/": "website",
            "logout/" : "logout",
            '*notFound': 'notFound'
        },
        // notFound: function(){
        //     $("body").empty();
        //     window.location.href = 'https://Investment market.com/notfound/';
        // },
        overview: function(){
            if(App.Globals.CurrentView !== null) $(App.Globals.CurrentView.el).unbind();
            App.Globals.CurrentView = new App.Views.Page({template:'overview'});
            App.Functions.MenuActive('');
            document.title = 'Investment market - Finance & Crypto Display Advertising';
        },
        billing: function(){
            if(App.Globals.CurrentView !== null) $(App.Globals.CurrentView.el).unbind();
            App.Globals.CurrentView =  new App.Views.Page({template:'billing'});
            App.Functions.MenuActive('billing');
            document.title = 'Billing - Investment market - Finance & Crypto Display Advertising';
        },
        profile: function(){
            if(App.Globals.CurrentView !== null) $(App.Globals.CurrentView.el).unbind();
            App.Globals.CurrentView =  new App.Views.Page({template:'profile'});
            App.Functions.MenuActive('profile');
            document.title = 'My Profile - Investment market - Finance & Crypto Display Advertising';
        },
        blacklist: function(){
            if(App.Globals.CurrentView !== null) $(App.Globals.CurrentView.el).unbind();
            App.Globals.CurrentView =  new App.Views.Page({template:'blacklist'});
            App.Functions.MenuActive('blacklist');
            document.title = 'My Global Blacklist - Investment market - Finance & Crypto Display Advertising';
        },
        security: function(){
            if(App.Globals.CurrentView !== null) $(App.Globals.CurrentView.el).unbind();
            App.Globals.CurrentView =  new App.Views.Page({template:'security'});
            App.Functions.MenuActive('security');
            document.title = 'Account Security - Investment market - Finance & Crypto Display Advertising';
        },
        withdraw: function(){
            if(App.Globals.CurrentView !== null) $(App.Globals.CurrentView.el).unbind();
            App.Globals.CurrentView =  new App.Views.Page({template:'withdraw-crypto'});
            App.Functions.MenuActive('billing');
            document.title = 'Withdraw Funds - Investment market - Finance & Crypto Display Advertising';
        },
        withdrawBank: function(){
            if(App.Globals.CurrentView !== null) $(App.Globals.CurrentView.el).unbind();
            App.Globals.CurrentView =  new App.Views.Page({template:'withdraw-bank'});
            App.Functions.MenuActive('billing');
            document.title = 'Withdraw to Bank Account - Investment market - Finance & Crypto Display Advertising';
        },
        deposit: function(){
            if(App.Globals.CurrentView !== null) $(App.Globals.CurrentView.el).unbind();
            App.Globals.CurrentView =  new App.Views.Page({template:'deposit-crypto'});
            App.Functions.MenuActive('billing');
            document.title = 'Crypto Deposit - Investment market - Finance & Crypto Display Advertising';
        },
        depositBankTransfer: function(){
            if(App.Globals.CurrentView !== null) $(App.Globals.CurrentView.el).unbind();
            App.Globals.CurrentView =  new App.Views.Page({template:'deposit-bank-transfer'});
            App.Functions.MenuActive('billing');
            document.title = 'Bank Transfer Deposit - Investment market - Finance & Crypto Display Advertising';
        },
        depositInstantCrypto: function(){
            if(App.Globals.CurrentView !== null) $(App.Globals.CurrentView.el).unbind();
            App.Globals.CurrentView =  new App.Views.Page({template:'deposit-crypto-instant'});
            App.Functions.MenuActive('billing');
            document.title = 'Instant Crypto Deposit - Investment market - Finance & Crypto Display Advertising';
        },
        redeemCoupon: function(){
            if(App.Globals.CurrentView !== null) $(App.Globals.CurrentView.el).unbind();
            App.Globals.CurrentView =  new App.Views.Page({template:'redeem-coupon'});
            App.Functions.MenuActive('billing');
            document.title = 'Redeem a Coupon - Investment market - Finance & Crypto Display Advertising';
        },
        changePassword: function(){
            if(App.Globals.CurrentView !== null) $(App.Globals.CurrentView.el).unbind();
            App.Globals.CurrentView =  new App.Views.Page({template:'change-password'});
            App.Functions.MenuActive('profile');
            document.title = 'Change Password - Investment market - Finance & Crypto Display Advertising';
        },
        emailSettings: function(){
            if(App.Globals.CurrentView !== null) $(App.Globals.CurrentView.el).unbind();
            App.Globals.CurrentView =  new App.Views.Page({template:'email-settings'});
            App.Functions.MenuActive('profile');
            document.title = 'Email Settings - Investment market - Finance & Crypto Display Advertising';
        },
        deleteAccount: function(){
            if(App.Globals.CurrentView !== null) $(App.Globals.CurrentView.el).unbind();
            App.Globals.CurrentView =  new App.Views.Page({template:'delete-account'});
            App.Functions.MenuActive('profile');
            document.title = 'Delete Account - Investment market - Finance & Crypto Display Advertising';
        },
        twoFactorAuthentication: function(){
            if(App.Globals.CurrentView !== null) $(App.Globals.CurrentView.el).unbind();
            App.Globals.CurrentView =  new App.Views.Page({template:'2fa'});
            App.Functions.MenuActive('security');
            document.title = '2FA Settings - Investment market - Finance & Crypto Display Advertising';
        },
        reports: function(uid){
            if(App.Globals.CurrentView !== null) $(App.Globals.CurrentView.el).unbind();
            App.Globals.CurrentView =  new App.Views.Reports({attr: {'uid':uid},template:"reports"});
            App.Functions.MenuActive('reports');
            document.title = 'Reports - Investment market - Finance & Crypto Display Advertising';
        },
        optimize: function(uid){
            if(App.Globals.CurrentView !== null) $(App.Globals.CurrentView.el).unbind();
            App.Globals.CurrentView =  new App.Views.Reports({attr: {'uid':uid},template:"optimize"});
            App.Functions.MenuActive('campaigns');
            document.title = 'Optimize Campaign - Investment market - Finance & Crypto Display Advertising';
        },
        performance: function(uid){
            if(App.Globals.CurrentView !== null) $(App.Globals.CurrentView.el).unbind();
            App.Globals.CurrentView =  new App.Views.Reports({attr: {'uid':uid},template:"performance"});
            App.Functions.MenuActive('campaigns');
            document.title = 'Campaign Performance - Investment market - Finance & Crypto Display Advertising';
        },
        referralProgram: function(){
            if(App.Globals.CurrentView !== null) $(App.Globals.CurrentView.el).unbind();
            App.Globals.CurrentView =  new App.Views.Page({template:'referral-program'});
            App.Functions.MenuActive('referral-program');
            document.title = 'Refer a Friend - Investment market - Finance & Crypto Display Advertising';
        },
        campaigns: function(){
            if(App.Globals.CurrentView !== null) $(App.Globals.CurrentView.el).unbind();
            App.Globals.CurrentView =  new App.Views.Page({template:'campaigns',page:'create-display-campaign'});
            App.Functions.MenuActive('campaigns');
            document.title = 'Campaigns - Investment market - Finance & Crypto Display Advertising';
        },
        campaignDenis: function(){
            if(App.Globals.CurrentView !== null) $(App.Globals.CurrentView.el).unbind();
            App.Globals.CurrentView =  new App.Views.Page({template:'campaigns',page:'create-display-campaign-2'});
            App.Functions.MenuActive('campaignDenis');
            document.title = 'Campaigns DENIS TEST';
        },
        displayCampaign: function(){
            if(App.Globals.CurrentView !== null) $(App.Globals.CurrentView.el).unbind();
            App.Globals.CurrentView =  new App.Views.Page({template:'campaigns',page:'create-display-campaign'});
            App.Functions.MenuActive('campaigns');
            document.title = 'Create a Display Campaign - Investment market - Finance & Crypto Display Advertising';
        },
        nativeCampaign: function(){
            if(App.Globals.CurrentView !== null) $(App.Globals.CurrentView.el).unbind();
            App.Globals.CurrentView =  new App.Views.Page({template:'campaigns',page:'create-native-campaign'});
            App.Functions.MenuActive('campaigns');
            document.title = 'Create a Native Campaign - Investment market - Finance & Crypto Display Advertising';
        },
        popunderCampaign: function(){
            if(App.Globals.CurrentView !== null) $(App.Globals.CurrentView.el).unbind();
            App.Globals.CurrentView =  new App.Views.Page({template:'campaigns',page:'create-popunder-campaign'});
            App.Functions.MenuActive('campaigns');
            document.title = 'Create a Popunder Campaign - Investment market - Finance & Crypto Display Advertising';
        },
        archivedCampaigns: function(){
            if(App.Globals.CurrentView !== null) $(App.Globals.CurrentView.el).unbind();
            App.Globals.CurrentView =  new App.Views.Page({template:'archived-campaigns'});
            App.Functions.MenuActive('campaigns');
            document.title = 'Archived Campaigns - Investment market - Finance & Crypto Display Advertising';
        },
        websites: function(){
            if(App.Globals.CurrentView !== null) $(App.Globals.CurrentView.el).unbind();
            App.Globals.CurrentView =  new App.Views.Page({template:'websites',page:'new-website'});
            App.Functions.MenuActive('websites');
            document.title = 'Websites - Investment market - Finance & Crypto Display Advertising';
        },
        newWebsite: function(){
            if(App.Globals.CurrentView !== null) $(App.Globals.CurrentView.el).unbind();
            App.Globals.CurrentView =  new App.Views.Page({template:'websites',page:'new-website'});
            App.Functions.MenuActive('websites');
            document.title = 'New Website - Investment market - Finance & Crypto Display Advertising';
        },
        website: function(uid){
            if(App.Globals.CurrentView !== null) $(App.Globals.CurrentView.el).unbind();
            App.Globals.CurrentView =  new App.Views.Page({template:'websites',page:'website',attr: {'uid':uid}});
            App.Functions.MenuActive('websites');
            document.title = 'Website - Investment market - Finance & Crypto Display Advertising';
        },
        campaign: function(uid){
            if(App.Globals.CurrentView !== null) $(App.Globals.CurrentView.el).unbind();
            App.Globals.CurrentView =  new App.Views.Page({template:'campaigns',page:'campaign',attr: {...this.getParams(),...{'uid':uid}}});
            App.Functions.MenuActive('campaigns');
            document.title = 'Campaign Settings - Investment market - Finance & Crypto Display Advertising';
        },
        logout: function(){
            setTimeout(function(){ window.location.href = 'logout/'; }, 2000);
        }
    });
    App.Views.ParentView = Backbone.View.extend({
        _activeForm : true,
        globalEvents: {
            'click a.navigate' : 'navigate',
            'click div.navigate' : 'navigateTo',
            'click a.active' : function (e) { e.preventDefault();},
            'click a.disabled' : function (e) { e.preventDefault();},
            'submit form': 'formSubmit',
            'keyup .digit': 'nextDigit',
            'focus .digit': 'removeDigit',
            'click .copy' : 'copy',
            'click .contact' : 'contact',
            'click .advanced' : 'advanced',
            'click .show-modal': 'showModal',
            'click .confirm': 'confirm',
            'keyup .password-strength':'passwordStrength',
            'click .card-toggle .card-body':'toggleCardFooter',
            'input .list-search .search':'searchResults',
            'select2:close .select-count':'selectCount',
            'select2:close .select-count-cp':'selectCountCP',
            'select2:close .select-count-campaigns':'selectCountCampaigns',
            'select2:open .select-count-campaigns':'selectCountCampaignsOpen',
            'click .list-available .item': 'selectList',
            'click .quickSelectCountry a': 'quickSelectCountry',
            'click .list-selected .item': 'deselectList',
            'click .selected-card .reset':'deselectAll',
            'click .select-all':'selectAll',
            'click .toggle-button' : 'toggleElement',
            'input .card-select .search':'searchTableSelect',
            'input .form-control.limit':'limitCharactersInput',
        },
        customEvents: {},
        events : function() {
            return _.extend({},this.globalEvents,this.customEvents);
        },
        advanced : function (e){
            e.preventDefault();
            var _this = $(e.currentTarget);
            var _that = $(_this.data("id"));

            if (_that.hasClass("on")) {
                _this.removeClass("active");
                _that.removeClass("on");
                _this.find(".toggle_text").html("<span class='far fa-plus-circle'></span>");
                _that.stop(true, false).slideToggle(300);
            } else {
                $('.advanced-settings.on').stop(true, false).slideToggle(300);
                $('.advanced').find(".toggle_text").html("<span class='far fa-plus-circle'></span>");
                $('.advanced-settings').removeClass('on');
                _this.find(".toggle_text").html("<span class='far fa-minus-circle'></span>");
                _this.addClass("active");
                _that.addClass("on");
                _that.stop(true, false).slideToggle(300);
            }
        },
        showModal: function(e){
            e.preventDefault();
            var _this = $(e.currentTarget);
            var arr = {};
            arr["name"] = _this.data("action");
            arr["attr"] = {};
            if(typeof _this.data("id") !== 'undefined'){
                arr["attr"]["uid"] = _this.data("id");
            }
            if(typeof _this.data("type") !== 'undefined') {
                arr["attr"]["type"] = _this.data("type");
            }
            App.Functions.Modal(JSON.stringify(arr));
        },
        toggleElement: function(e) {
            e.preventDefault();
            var target = $(e.currentTarget).data('toggle');
            $(target).stop(true, false).slideToggle(300);
        },
        confirm: function(e){
            e.preventDefault();
            var _this = $(e.currentTarget),
                target = _this.data("target"),
                uid = _this.data("uid");
            if(typeof uid === 'undefined'){
                uid = null;
            }
            swal({
                title: 'Are you sure?',
                text: "You may not be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#2e7cf6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes!'
            }).then(function () {
                $.ajax({
                    url: 'assets/api/'+target,
                    type: 'POST',
                    data: {
                        "confirmed": true,
                        "uid": uid
                    },
                    success: function(response){
                        response = JSON.parse(response);
                        swal(
                            'Done!',
                            'Your action has been completed.',
                            'success'
                        );
                        if(typeof response.fn !== "undefined") {
                            window.App.Functions[response.fn](response.message);
                        }
                    },
                    error: function(response) {
                        response = JSON.parse(response.responseText);
                        if(response.message){
                            swal("Oops!", response.message, "error");
                        }else{
                            App.Functions.Redirect("https://Investment market.com/maintenance/");
                        }
                    }
                });
            });
        },
        copy : function(e){
            e.preventDefault();
            var _this = $(e.currentTarget);
            var id = _this.data("id");
            var text = _this.html();
            $("#"+id).select();
            document.execCommand("copy");
            _this.html("Copied!");
            setTimeout(function () {
                _this.html(text);
            },1000)
        },
        navigate : function (e) {
            e.preventDefault();
            $('.toggle-content').hide();
            $('.navbar-collapse').collapse('hide');
            var path = $(e.currentTarget).attr("href");
            Backbone.history.navigate(path, {trigger:true});
        },
        navigateTo : function (e) {
            e.preventDefault();
            var path = $(e.currentTarget).data("href");
            Backbone.history.navigate(path, {trigger:true});
        },
        formSubmit: function (e) {
            var selector = $(e.currentTarget);
            selector.find("input,select,textarea").removeClass("border border-danger border-success");
            $("label").removeClass("text-danger text-success");
            selector.find(".submit-icon").removeClass("fa-check").addClass("fa-spinner fa-pulse");
            if(this._activeForm === false){
                e.preventDefault();
                return;
            }
            this._activeForm = false;
            if(!selector.attr("action")){
                selector.submit();
                return;
            }
            if(selector.hasClass("post")){
                selector.submit();
                return;
            }

            var formURL = "assets/api/"+selector.attr("action");
            var formData = new FormData(e.currentTarget);
            var that = this;
            $.ajax({
                url: formURL,
                type: "POST",
                data: formData,
                mimeType: "multipart/form-data",
                contentType: false,
                cache: false,
                processData: false,
                success: function (data, textStatus, $XHR) {
                    that._activeForm = true;
                    var response = JSON.parse(data);
                    if(typeof response.fn !== "undefined") {
                        window.App.Functions[response.fn](response.message);
                    }else{
                        if(typeof response.success !== "undefined") {
                            if(response.success === "false"){
                                swal("Oops!", response.message, "error");
                            }else {
                                swal("Great!", response.message, "success");
                            }
                        }else{
                            swal("Great!", response.message, "success");
                        }
                    }
                    App.Globals.Alert.render();
                    selector.find(".submit-icon").removeClass("fa-spinner fa-pulse").addClass("fa-check");
                },
                error: function (request, status, error) {
                    that._activeForm = true;
                    var response = JSON.parse(request.responseText);
                    if(typeof response.message !== "undefined"){
                        swal("Oops!", response.message, "error");
                    }else{
                        App.Functions.Redirect("https://Investment market.com/maintenance/");
                    }
                    selector.find(".submit-icon").removeClass("fa-spinner fa-pulse").addClass("fa-check");
                }
            });
            e.preventDefault();
        },
        afterRender: function(){
            $('[data-toggle="tooltip"]').tooltip();
            $('.dtable').DataTable({
                responsive: true,
                "order": []
            } );
            this.tableSelect();
            $('.select2').select2();
            $('.select-count').trigger('select2:close');
            $('.select-count-cp').trigger('select2:close');
            $(".date-pick").daterangepicker({
                locale: {
                    format: 'YYYY-MM-DD'
                },
                singleDatePicker: true,
                showDropdowns: true
            });
            $('.daterange').daterangepicker({
                locale: {
                    format: 'YYYY-MM-DD'
                },
                startDate: $(".startDate").val(),
                endDate: $(".endDate").val(),
                minDate:moment().subtract(1, 'years'),
                maxDate:moment(),
                applyClass: "btn-primary",
                cancelClass: "btn-dark",
                orientation: "auto",
                alwaysShowCalendars: true,
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                    'Last 3 Months': [moment().subtract(90, 'days'), moment()]
                }
            }, function(start, end, label) {
                $(".startDate").val(start.format('YYYY-MM-DD'));
                $(".endDate").val(end.format('YYYY-MM-DD'));
            });
            $('#modal').on('hidden.bs.modal', function () {
                $("#modal .modal-content").html("");
            });
        },
        nextDigit: function (e) {

            if((e.keyCode === 8 || e.key === "Backspace") && e.currentTarget.value==="") {
                $(e.currentTarget).prev('.digit').focus();
                return;
            }

            if (!$.isNumeric(e.currentTarget.value)) {
                $(e.currentTarget).val("");
                return;
            }
            if (e.currentTarget.value.length == e.currentTarget.maxLength) {
                $(e.currentTarget).next('.digit').focus();
            }
        },
        removeDigit: function(e){
            $(e.currentTarget).val("");
        },
        passwordStrength: function(e) {
            var _this = $(e.currentTarget);
            var password = _this.val();
            var strength = 0;
            var lineBellow = _this.siblings('.line-strength');
            if (!$(lineBellow).hasClass('show')) {
                $(lineBellow).addClass('show');
            }
            if(password.length === 0 || password === "") {
                lineBellow.removeClass('show');
            }
            if (password.length <= 7) {
                lineBellow.removeClass('weak good strong');
                lineBellow.addClass('short');
                return 'Too short'
            }
            if (password.length > 7) strength += 1;
            if (password.match(/([a-z].)|(.[a-z])/)) strength += 1;
            if (password.match(/([A-Z].)|(.[A-Z])/)) strength += 1;
            if (password.match(/([a-zA-Z])/) && password.match(/([0-9])/)) strength += 1;
            if (password.match(/([^A-Za-z0-9])/)) strength += 1;


            if (strength < 4) {
                lineBellow.removeClass('short good strong');
                lineBellow.addClass('weak');
                return 'Weak'
            } else if (strength == 4) {
                lineBellow.removeClass('weak short strong');
                lineBellow.addClass('good');
                return 'Good'
            } else {
                lineBellow.removeClass('weak good short');
                lineBellow.addClass('strong');
                return 'Strong'
            }
        },
        limitCharactersInput :function(e){
            var _this = $(e.currentTarget),
                maxLength = _this.attr('maxlength'),
                length = _this.val().length,
                remaining = maxLength - length,
                _span = _this.next("span.limit");
            if(remaining <= 0) {
                remaining = 0;
                _span.addClass("text-danger");
            }else{
                _span.removeClass("text-danger");
            }
            _span.attr("data-remaining",remaining);
        },
        toggleCardFooter: function(e) {
            $(e.currentTarget).siblings('.card-footer').stop(true,false).slideToggle(300);
        },
        searchResults: function(e) {
            var text = $(e.target).val();
            var textSplit = text.toLowerCase().split(' ');
            var flagResults = true;
            if ($('.search-results .no-data').length === 0) {
                $('.search-results').append('<div class="no-data">No data found</div>');
            }
            if (text.length === 0) {
                $('.search-results .day').removeClass('hidden');
                $('.search-results .no-data').removeClass('show');
                return;
            }
            $.each($('.search-results .day'), function (key, item) {
                var title = $(item).data('title').toLowerCase();
                var date = $(item).data('date').toLowerCase();
                var status = $(item).data('status').toLowerCase();
                var found = false;
                _.each(textSplit, function (string) {
                    var regExp = new RegExp(string);
                    if (title.search(regExp) !== -1 || date.search(regExp) !== -1 || status.search(regExp) !== -1) {
                        $(item).removeClass('hidden');
                        found = true;
                        flagResults = false;
                    }
                });
                if(!found) {
                    $(item).addClass('hidden');
                }
            });
            flagResults ? $('.search-results .no-data').addClass('show') : $('.search-results .no-data').removeClass('show');
        },
        selectCount:function(e) {
            var uldiv = $(e.currentTarget).siblings('span.select2').find('ul');
            var countSelected =$(e.currentTarget).select2('data').length;
            if(countSelected !== 0 ) {
                uldiv.html("<li>"+ countSelected + " " + $(e.target).data('selected') + "</li>");
            }
            else {
                uldiv.html("<li>"+ $(e.target).data('noelements') + "</li>");
            }
        },

        selectCountCP:function(e) {
            var uldiv = $(e.currentTarget).siblings('span.select2').find('ul');
            var countSelected =$(e.currentTarget).select2('data').length;

            $(uldiv).find('.select2-selection__choice').remove();
            $(uldiv).find('.select2-selection__clear').remove();
            $(uldiv).find('.selected-option-custom').remove();

            if(countSelected !== 0 ) {
                uldiv.prepend("<li class='selected-option-custom'>"+ countSelected + " " + $(e.target).data('selected') + "</li>");
            }
            else {
                uldiv.prepend("<li class='selected-option-custom'>"+ $(e.target).data('noelements') + "</li>");
            }
        },

        selectCountCampaigns:function(e,item) {
            var uldiv = $(e.currentTarget).siblings('span.select2').find('ul');
            var countSelected =$(e.currentTarget).select2('data').length;
            var element = e.currentTarget;

            $(uldiv).find('.select2-selection__choice').remove();
            $(uldiv).find('.select2-selection__clear').remove();
            $(uldiv).find('.selected-option-custom').remove();

            if(countSelected !== 0 ) {
                if($(element).val().includes('all')){
                    uldiv.prepend("<li class='selected-option-custom'>All Campaigns</li>");
                }else {
                    uldiv.prepend("<li class='selected-option-custom'>" + countSelected + " " + $(e.target).data('selected') + "</li>");
                }
            }
            else {
                uldiv.prepend("<li class='selected-option-custom'>"+ $(e.target).data('noelements') + "</li>");
            }
            $(uldiv).find('.select2-search.select2-search--inline').css("display","none");
            $(uldiv).find('.selected-option-custom').css("display","block");
        },
        selectCountCampaignsOpen:function(e,item) {
            var uldiv = $(e.currentTarget).siblings('span.select2').find('ul');
            $(uldiv).find('.selected-option-custom').css("display","none");
            $(uldiv).find('.select2-search.select2-search--inline').css("display","inline-block");
            $(uldiv).find('.select2-search.select2-search--inline input').css("margin","0").focus();
            $(uldiv).parent('.select2-selection--multiple').css("padding","9px 15px");
            $(uldiv).parent('.select2-selection--multiple').css("margin","0");
        },

        selectList: function(e,item,forceAll) {
            var element;
            if (typeof item === "undefined") {
                element = e.currentTarget;
            }
            else {
                element = item;
            }
            if($(element).hasClass('selected') && (typeof forceAll === "undefined")) {
                this.deselectList('',$(element).parents('.table-select').find('.list-selected .item[data-save="'+$(element).data('save') +'"]'));
                return;
            }
            var actionElement =$(element).parents('.table-select'). find('.list-selected .item[data-save="' + $(element).data('save') + '"]');
            $(element).addClass('selected');
            actionElement.addClass('selected');
            actionElement.find('input').prop("checked", true);
            this.changeDataTable('add',$(element).data('category'),$(element).data('save'));
            (typeof item === "undefined") ? this.eventFire(e, '.item', 'select') : this.eventFire('', '.item', 'select', item);

        },
        quickSelectCountry: function(e) {
            var countries = $(e.target).data('countries');
            var _this = this;
            this.deselectAllQuickCountry(e);
            $.each(countries,function(e,itemC){
                var element = $(".table-select").find('.list-selected .item[data-save="' + itemC + '"]');
                if(element.length>0) {
                    if ($(element).hasClass('selected') && (typeof forceAll === "undefined")) {
                        _this.deselectList('', $(element).parents('.table-select').find('.list-selected .item[data-save="' + itemC + '"]'));
                        return;
                    }

                    var actionElement = $(element).parents('.table-select').find('.list-available .item[data-save="' + itemC + '"]');
                    $(element).addClass('selected');
                    actionElement.addClass('selected');
                    $(element).find('input').prop("checked", true);
                    _this.changeDataTable('add', 'countries', itemC);
                    (typeof element === "undefined") ? _this.eventFire(e, '.item', 'select') : _this.eventFire('', '.item', 'select', element);
                }
            });
        },
        deselectList:function(e,item) {
            var element;
            if(typeof item === "undefined") {
                element = e.currentTarget;
                $(element).parents('.table-select').find('.list-available .item[data-save="'+$(element).data('save') +'"]').removeClass('selected');
                $(element).removeClass('selected');
                $(element).find('input').prop( "checked", false);
                this.eventFire(e,'.item','deselect');
            }
            else {
                element = item;
                $(element).parents('.table-select').find('.list-available .item[data-save="'+$(element).data('save') +'"]').removeClass('selected');
                $(element).removeClass('selected');
                $(element).find('input').prop( "checked", false);
                this.eventFire('','.item','deselect',item);
            }
            this.changeDataTable('remove',$(element).data('category'),$(element).data('save'));
        },
        eventFire:function(e,selector,action,item){
            var element = (typeof item!== "undefined") ? item : e.currentTarget;
            var currentEmelent =$(element).parent('.list-select');
            if (action === "select") {
                $(element).parents('.table-select').find('.selected-card .list-select').find('.no-data').removeClass('active');
                if(currentEmelent.find('.selected').length === currentEmelent.find('.item').length) {
                    currentEmelent.find('.no-data').addClass('active');
                }
            }
            if (action === "deselect") {
                $(element).parents('.table-select').find('.browse-card .list-select').find('.no-data').removeClass('active');
                if (currentEmelent.find(selector + '.selected').length === 0) {
                    currentEmelent.find('.no-data').addClass('active');
                }
                else {
                    currentEmelent.find('.no-data').removeClass('active');
                }
            }

        },
        deselectAll:function(e) {
            e.preventDefault();
            var _this = this;
            $.each($(e.currentTarget).parents('.table-select').find('.selected-card .day.selected'),function(key,item){
                _this.deselectList('',item);
            });
        },
        deselectAllQuickCountry:function(e) {
            e.preventDefault();
            var _this = this;
            $.each($(e.currentTarget).parents('.table-select').find('.selected-card .day.selected'),function(key,item){
                _this.deselectList(e,item);
            });
        },
        selectAll:function(e) {
            e.preventDefault();
            var _this = this;
            var category = $(e.currentTarget).parents('.table-select');
            $.each(category.find('.browse-card .item'), function (key, item) {
                if(!$(item).hasClass('selected')) {
                    _this.selectList('', item,true);
                }
            });
        },
        searchTableSelect: function (e) {
            var text = $(e.target).val();
            var textSplit = text.toLowerCase().split(' ');
            var currentTable = $(e.currentTarget).parents('.card-select');
            if (text.length === 0) {
                currentTable.find('.list-select .item').removeClass('hidden');
                currentTable.find('.list-select .no-data').removeClass('show');
                return;
            }
            var flagResults = true;
            $.each(currentTable.find('.item'), function (key, item) {
                var description = $(item).data('description').toLowerCase();
                var keywords = $(item).data('save').toLowerCase();
                var category = $(item).data('category').toLowerCase();
                var found = false;
                $.each(textSplit, function (index, string) {
                    var regExp = new RegExp(string);
                    if (description.search(regExp) !== -1 || keywords.search(regExp) !== -1 || category.search(regExp) !== -1) {
                        $(item).removeClass('hidden');
                        found = true;
                        flagResults = false;
                    }
                });
                if (!found) {
                    $(item).addClass('hidden');
                }
            });
            flagResults ? $(currentTable).find('.no-data').addClass('show') : $(currentTable).find('.no-data').removeClass('show');
        },
        tableSelect:function() {
            App.Globals.TableSelect = {};
            $('.list-select').append('<div class="no-data">No data available </div>');
            $.each($('.list-select'),function(key,item) {
                if ($(item).find('.day.selected').length===0) {
                    if ($(item).hasClass('list-selected')) {
                        $(item).find('.no-data').addClass('active');
                    }
                }
                if ($(item).find('.day.selected').length === $(item).find('.day').length) {
                    if ($(item).hasClass('list-available')) {
                        $(item).find('.no-data').addClass('active');
                    }
                }
                if($(item).hasClass('list-selected')) {
                    $.each($(item).find('.day'), function (key,value) {
                        if($(value).hasClass('selected')) {
                            $(value).append('<input type="checkbox" name="'+$(value).data("category")+'[]" value="'+$(value).data("save")+'" checked="checked" />');
                            if(App.Globals.TableSelect.hasOwnProperty($(value).data("category"))) {
                                App.Globals.TableSelect[$(value).data("category")].push($(value).data("save"));
                            }
                            else {
                                App.Globals.TableSelect[$(value).data("category")] =[];
                                App.Globals.TableSelect[$(value).data("category")].push($(value).data("save"));
                            }
                        }
                        else {
                            if(!App.Globals.TableSelect.hasOwnProperty($(value).data("category"))) {
                                App.Globals.TableSelect[$(value).data("category")] =[];
                            }
                            $(value).append('<input type="checkbox" name="'+$(value).data("category")+'[]" value="'+$(value).data("save")+'"/>');
                        }
                    });
                }
            });
            $.each(App.Globals.TableSelect, function (key, value) {
                $('.'+key+".count").html(value.length);
            });
        },
        changeDataTable: function(action,category,value) {
            if(action === 'add') {
                if(App.Globals.TableSelect.hasOwnProperty(category)) {
                    App.Globals.TableSelect[category].push(value);
                }
                else {
                    App.Globals.TableSelect[category]=[];
                    App.Globals.TableSelect[category].push(value);
                }
            }
            else {
                App.Globals.TableSelect[category] = $.map(App.Globals.TableSelect[category], function (val)  {
                    return val !== value ? val : null;
                });
            }
            $('.'+category+'.count').html(App.Globals.TableSelect[category].length);
        },
        loading: function (status) {
            if (status === 'start') {
                $("#wrapperHandler").addClass("blur");
                $('#wrap__loading').html('<div class="loading-bar loading"></div>');
            }
            if(status === 'done'){
                $('.loading-bar').addClass('done');
                $("#wrapperHandler").removeClass("blur");
                setTimeout(function () {
                    $(".loading-bar").animate({
                        opacity: 'hide',
                        left: '100%'
                    }, 'slow', 'linear', function() {
                        $(this).remove();
                    });
                }, 300);
            }
        },
        contact: function (e) {
            e.preventDefault();
            Intercom('show');
        }
    });
    App.Functions.Redirect = function(path){
        if(typeof path.status !== 'undefined') {
            if (path.status === 503) {
                window.location.href = 'https://Investment market.com/maintenance/';
            }
            if (path.status === 500) {
                window.location.href = 'https://Investment market.com/maintenance/';
            }
            if (path.status === 501) {
                window.location.href = 'https://Investment market.com/maintenance/';
            }
            if (path.status === 401) {
                window.location.href = 'https://display.Investment market.com/logout/';
            }
            if (path.status === 404) {
                window.location.href = 'https://Investment market.com/notfound/';
            }
            if (path.status === 403) {
                window.location.href = 'https://display.Investment market.com/logout/';
            }
        }else{
            window.location.href = path;
        }
    };
    App.Functions.Reload = function(){
        $("#modal.show").modal('hide');
        Backbone.history.loadUrl(Backbone.history.fragment);
        App.Globals.Alert.render();
    };
    App.Functions.Message = function(content,type){
        swal("Oops!", content, type);
    };
    App.Functions.Modal = function(data){
        data = JSON.parse(data);
        if(typeof data.attr === 'undefined'){
            data.attr = {};
        }
        $.post("assets/templates/modal/"+data.name+"/", data.attr, function (result) {
            $(".modal-content").first().html(result);
            $('#modal').first().modal('show');
        }).fail(function(error) {
            swal("Oops!", "An error occurred, please try again or contact us.", "error");

        });
    };
    App.Functions.Confirmation = function(data){
        $("#modal.show").modal('hide');
        var json = JSON.parse(data);
        swal(json.title, json.content, "success");
        if(typeof json.redirect !== 'undefined'){
            Backbone.history.navigate(json.redirect, {trigger:true});
        }else {
            Backbone.history.loadUrl(Backbone.history.fragment);
        }
    };
    App.Functions.MenuActive = function(page){
        $("#mainNavBar ul li").removeClass('active');
        $('a[href^="' + page + '/"]').parent().addClass('active');
    };
    App.Functions.SubPage = function(data){
        data = JSON.parse(data);
        if(typeof data.attr === 'undefined'){
            data.attr = {};
        }
        $.post("assets/templates/pages/"+data.name+"/", data.attr, function (result) {
            $("#list-content").html(result);
            App.Globals.CurrentView.afterRender();
        }).fail(function(error) {
            swal("Oops!", "An error occurred, please try again or contact us.", "error");
        });
    };
    App.Globals.CurrentView = null;
    App.Views.Header = App.Views.ParentView.extend({
        el: '#headerHandler',
        customEvents:{
            'click a.logout' : 'logout'
        },
        logout : function (e) {
            e.preventDefault();
            $.ajax({
                url: 'api/logout/',
                type: 'GET',
                error: function(xhr) {
                    App.Functions.Redirect(xhr);
                }
            });
        },
        template: _.template($("#headerHandlerView").html()),
        initialize: function () {
            this.render();
        },
        render: function () {
            this.$el.html(this.template());
        }
    });
    App.Views.Alert = App.Views.ParentView.extend({
        el: '#alertHandler',
        initialize: function () {
            this.render();
        },
        render: function () {
            var that = this;
            $.get('assets/templates/pages/alert/', function (data) {
                that.template = _.template(data);
                that.$el.html(that.template());
            });
        }
    });
    App.Views.Footer = App.Views.ParentView.extend({
        el: '#footerHandler',
        template: _.template($("#footerHandlerView").html()),
        initialize: function () {
            this.render();
        },
        render: function () {
            this.$el.html(this.template());
        }
    });
    App.Views.Modal = App.Views.ParentView.extend({
        el: '#modalHandler',
        template: _.template($("#modalHandlerView").html()),
        initialize: function () {
            this.render();
        },
        render: function () {
            this.$el.html(this.template({general: null}));
        }
    });
    App.Views.Page = App.Views.ParentView.extend({
        el: '#wrapperHandler',
        initialize: function (options) {
            this.loading('start');
            this.render(options);
        },
        render: function (options) {
            var that = this;
            if(typeof options.attr === 'undefined'){
                options.attr = {}
            }
            $.get('assets/templates/pages/' + options.template + '/', options.attr, function (data) {
                that.$el.html(data);
                that.afterRender();
                if(typeof options.page !== 'undefined'){
                    $.get('assets/templates/pages/' + options.page + '/', options.attr, function (result) {
                        $("#list-content").html(result);
                        that.afterRender();
                    }).fail(function( xhr, textStatus, errorThrown ) {
                        App.Functions.Redirect(xhr.status);
                    });
                }
                if(typeof App.Globals.Footer === 'undefined')
                    App.Globals.Footer = new App.Views.Footer();
            }, 'html').done(function(){
                that.loading('done');
            }).fail(function( xhr, textStatus, errorThrown ) {
                App.Functions.Redirect(xhr.status);
            });
        }
    });
    App.Views.Reports = App.Views.ParentView.extend({
        el: '#wrapperHandler',
        customEvents: {
            'click .switchable': 'disableZones'
        },
        disableZones : function (e){
            var value = 0;
            var _this = $(e.currentTarget);
            if(_this.is(":checked")) {
                value = 1;
            }
            var id = _this.data("u");
            var parent = _this.data("parent");
            $.post("assets/api/target-zones/", {parent:parent,u:id,value:value}).fail(function( xhr, textStatus, errorThrown ) {
                App.Functions.Redirect(xhr.status);
            });
        },
        initialize: function (options) {
            this.loading('start');
            this.render(options);
        },
        formSubmit: function (e) {
            if(this._activeForm === false){
                e.preventDefault();
                return;
            }
            this.loading('start');
            this._activeForm = false;
            var formURL ='assets/templates/pages/'+this.loadTemplate+'/';
            var formData = new FormData(e.currentTarget);
            var that = this;
            $.ajax({
                url: formURL,
                type: "POST",
                data: formData,
                mimeType: "multipart/form-data",
                contentType: false,
                cache: false,
                processData: false,
                success: function (data, textStatus, $XHR) {
                    that._activeForm = true;
                    that.template = _.template(data);
                    that.$el.html(that.template());
                    that.afterRender();
                    that.loading('done');
                },
                error: function (request, status, error) {
                    that._activeForm = true;
                    var response = JSON.parse(request.responseText);
                    if(response.message){
                        swal("Oops!", response.message, "error");
                    }else{
                        App.Functions.Redirect(status);
                    }
                    that.loading('done');
                }
            });
            e.preventDefault();
        },
        render: function (options) {
            var that = this;
            if(typeof options.attr === 'undefined'){
                options.attr = {}
            }
            this.loadTemplate = options.template;
            $.get('assets/templates/pages/'+this.loadTemplate+'/', options.attr, function (data) {
                that.$el.html(data);
                that.afterRender();
                if(typeof App.Globals.Footer === 'undefined')
                    App.Globals.Footer = new App.Views.Footer();
            }, 'html').done(function(){
                that.loading('done');
            }).fail(function( xhr, textStatus, errorThrown ) {
                App.Functions.Redirect(xhr.status);
            });
        }
    });
    App.Views.UserInterface = App.Views.ParentView.extend({
        initialize: function(){
            new App.Views.Header();
            App.Globals.Alert = new App.Views.Alert();
            new App.Views.Modal();
            this.initializeRouter();
        },
        initializeRouter: function () {
            this.router = new App.Router();
            Backbone.history.start({ pushState: true, root: "/" });
        }

    });
    new App.Views.UserInterface();
});


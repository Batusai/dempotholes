var AppRouter = Backbone.Router.extend({

    routes: {
        ""                  : "home",
        "wines"             : "list",
        "wines/page/:page"  : "list",
        "wines/add"         : "addWine",
        "wines/:id"         : "wineDetails",
        "about"             : "about",
        "faqs"              : "faqs",
        "facts"	            : "facts"
    },

    initialize: function () {
        this.headerView = new HeaderView();
        $('.header').html(this.headerView.el);
    },

    home: function (id) {
        if (!this.homeView) {
            this.homeView = new HomeView();
        }
        $('#content').html(this.homeView.el);
    },

	facts: function () {
        if (!this.factView) {
            this.factView = new FactView();
        }
        $('#content').html(this.factView.el);
    },

	faqs: function () {
        if (!this.faqView) {
            this.faqView = new FaqView();
        }
        $('#content').html(this.faqView.el);
    },

    list: function (page) {
        var p = page ? parseInt(page, 10) : 1;
        var wineList = new WineCollection();
        wineList.fetch({success: function(){
            $("#content").html(new WineListView({model: wineList, page: p}).el);
        }});
    },

    wineDetails: function (id) {
        var wine = new Wine({_id: id});
        wine.fetch({success: function(){
            $("#content").html(new WineView({model: wine}).el);
        }});
    },

    addWine: function () {
        var wine = new Wine();
        $('#content').html(new WineView({model: wine}).el);
    },

    about: function () {
        if (!this.aboutView) {
            this.aboutView = new AboutView();
        }
        $('#content').html(this.aboutView.el);
    }

});

utils.loadTemplate(['HomeView', 'HeaderView', 'WineView', 'WineListItemView', 'AboutView', 'FaqView', 'FactView'], function() {
    app = new AppRouter();
    Backbone.history.stop();
    Backbone.history.start();
});
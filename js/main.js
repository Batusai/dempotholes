var AppRouter = Backbone.Router.extend({

    routes: {
        ""                  : "home",
        "report"            : "report",
        "faqs"              : "faqs",
        "facts"	            : "facts",
        "gallery"           : "gallery"
    },

    initialize: function () {
        this.headerView = new HeaderView();
        $('.header').html(this.headerView.el);
    },

    home: function () {
        if (!this.homeView) {
            this.homeView = new HomeView();
        }
        $('#content').html(this.homeView.el);
    },

    report: function () {
        if (!this.reportView) {
            this.reportView = new MRView();
        }
        $('#content').html(this.reportView.el);
    },

    saveIncident: function () {
        var incident = new Incident();
        $('#content').html(new MRView({model: incident}).el);
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

    gallery: function () {
        if (!this.galleryView) {
            this.galleryView = new GalleryView();
        }
        $('#content').html(this.galleryView.el);
    }

});

utils.loadTemplate(['HomeView', 'HeaderView', 'FaqView', 'FactView', 'GalleryView', 'MRView'], function() {
    app = new AppRouter();
    Backbone.history.stop();
    Backbone.history.start();
});
window.Report = Backbone.Model.extend({

    urlRoot: "api/incidents",

    initialize: function () {
        this.validators = {};


    },

    validateItem: function (key) {
        return (this.validators[key]) ? this.validators[key](this.get(key)) : {isValid: true};
    },

    // TODO: Implement Backbone's standard validate() method instead.
    validateAll: function () {

        var messages = {};

        for (var key in this.validators) {
            if(this.validators.hasOwnProperty(key)) {
                var check = this.validators[key](this.get(key));
                if (check.isValid === false) {
                    messages[key] = check.message;
                }
            }
        }

        return _.size(messages) > 0 ? {isValid: false, messages: messages} : {isValid: true};
    },

    defaults: {
        id: null,
        name: "",
        addr: "",
        direction: "",
        type: "",
        notes: "",
        picture: null
    }
});

window.ReportCollection = Backbone.Collection.extend({

    model: Report,

    url: "api/incidents"

});
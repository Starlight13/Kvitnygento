define([
        'underscore',
        'mageUtils',
        'uiLayout',
        'uiCollection',
        'mage/translate',
        'jquery'
    ], function (_, utils, layout, Collection, $t, $) {
        'use strict';

        function removeEmpty(data) {
            var result = utils.mapRecursive(data, utils.removeEmptyValues.bind(utils));

            return utils.mapRecursive(result, function (value) {
                return _.isString(value) ? value.trim() : value;
            });
        }

        var mixin = {
            apply: function () {
                this.set('applied', removeEmpty(this.filters));
                return this;
            }
        };
        return function (target) {
            return target.extend(mixin);
        };
    }
);

/**
 * This file generated by PropelJS: https://github.com/AthensFramework/PropelJS<?php
    if (sizeof($tableColumns > 0) && sizeof(array_values($tableColumns)[0] >= 2)) {
        $exampleTableName = array_keys($tableColumns)[0];
        $examplePluralTableName = $tablePlurals[$exampleTableName];
        $examplePhpTableName = $tablePhpNames[$exampleTableName];
        $exampleAttributeName = array_keys($tableColumns[$exampleTableName])[1];

    ?>

 *
 * Example use:
 * ```
 * var db = <?php echo $databaseName; ?>.propelJS({baseAddress:'/api/'});
 *
 * db.<?php echo $examplePluralTableName; ?>(2)
 *      .get()
 *      .then(
 *          function(<?php echo $exampleTableName; ?>) {
 *              <?php echo $exampleTableName; ?>.set<?php echo $exampleAttributeName; ?>('example-value').save();
 *          }
 *      );
 *
 * myNew<?php echo $examplePhpTableName; ?> = db.<?php echo $examplePluralTableName; ?>();
 * myNew<?php echo $examplePhpTableName; ?>.set<?php echo $exampleAttributeName; ?>('example-value')
 *      .save()
 *      .then(
 *          function(<?php echo $exampleTableName; ?>) {
 *              console.log(<?php echo $exampleTableName; ?>.getId());
 *          }
 *      );
 * ```
 *
 * Of course, this auto-generated example may not work correctly if your model
 * includes additional required fields, etc.
<?php } ?>
 *
 * See the documentation at https://github.com/AthensFramework/PropelJS
 *
 * Do not edit this file; any changes will be overwritten the next time
 * you run `propel model:build`.
 */

var <?php echo $databaseName; ?> = {};

<?php echo $databaseName; ?>.propelJS = (function() {

    var baseAddress = '';
    var headers = {};

    var doAJAX = function(method, relativeAddress, data) {

        return $.ajax(
            {
                method: method,
                url: baseAddress + relativeAddress,
                data: JSON.stringify(data),
                processData: false,
                dataType: 'json',
                beforeSend: function(jqXHR) {
                    for (var header in headers) {
                        if (headers.hasOwnProperty(header)) {
                            jqXHR.setRequestHeader(header, headers[header]);
                        }
                    }
                }
            }
        );
    };

    var Collection = function(resources) {

        var each = function(func) {
            for(var i = 0; i < resources.length; i++) {
                func(resources[i]);
            }
        };

        return {
        each: each
        }
    };

    <?php foreach ($tableColumns as $tableName => $columns) { ?>

    var <?php echo $tablePhpNames[$tableName]; ?> = function() {

        var
            attributes = {},
            pks = {},
            path = '<?=$tablePlurals[$tableName]?>/';

        const pkNames = ['<?= implode('\',\'', array_keys($tablePks[$tableName])) ?>'];

        for(var argi = 0; argi < arguments.length; argi++)
        {
            attributes[pkNames[argi]] = arguments[argi];
            path += arguments[argi] + '/';
        }

        /**
         * Internal method for getting an instance attribute.
         *
         * @param attributeName
         * @returns {*}
         */
        var getAttribute = function(attributeName)
        {
            return attributes.hasOwnProperty(attributeName) ? attributes[attributeName] : undefined;
        };

        /**
         * Internal method for setting an instance attribute.
         *
         * @param attributeName
         * @param attributeValue
         */
        var setAttribute = function(attributeName, attributeValue)
        {
            attributes[attributeName] = attributeValue;
        };

        /**
         * Get the Id attribute for this <?php echo $tableName; ?>.
         *
         * @returns {*}
         */
        var getPk = function()
        {
            return getAttribute(pkNames[0]);
        };<?php echo "\n"; foreach ($columns as $columnName => $columnType) { ?>

        /**
         * Set the <?php echo $columnName; ?> attribute for this <?php echo $tableName; ?>.
         *
         * @param new<?php echo $columnName; ?>

         */
        var set<?php echo $columnName; ?> = function(new<?php echo $columnName; ?>)
        {
            setAttribute('<?php echo $columnName; ?>', new<?php echo $columnName; ?>);

            return this;
        };

        /**
         * Get the <?php echo $columnName; ?> for this <?php echo $tableName; ?>.
         *
         * @returns {*}
         */
        var get<?php echo $columnName; ?> = function()
        {
            return getAttribute('<?php echo $columnName; ?>');
        };
    <?php } ?>

        /**
         * Perform the delete action for this <?php echo $tableName; ?>.
         *
         * @returns {*}
         */
        var remove = function()
        {
            return doAJAX(
                'DELETE',
                path
            ).then(function(result) {attributes = {}; return undefined;})
        };

        /**
         * Perform the retrieve action for this <?php echo $tableName; ?>.
         *
         * @returns {*}
         */
        var get = function()
        {
            var <?php echo $tableName; ?> = this;

            return doAJAX(
                'GET',
                path
            ).then(function(result) {attributes = result; return <?php echo $tableName; ?>;})
        };

        /**
        * Retrieve <?php echo $tablePlurals[$tableName]; ?> with attributes matching the current <?php echo $tableName; ?>.
        *
        * @returns {*}
        */
        var find = function()
        {
            return doAJAX(
                'GET',
                '<?php echo $tablePlurals[$tableName]; ?>/?' + $.param(attributes)
            ).then(function(result) {

                var results = [];
                for (var i = 0; i < result.data.length; i++) {
                    var <?php echo $tableName; ?> = <?php echo $tablePhpNames[$tableName]; ?>(result.data[i].Id);

                    for (var name in result.data[i]) {
                        if (result.data[i].hasOwnProperty(name)) {
                            var setter = "set" + name;

                            if (<?php echo $tableName; ?>.hasOwnProperty(setter)) {
                                <?php echo $tableName; ?>[setter](result.data[i][name]);
                            }
                        }
                    }
                    results.push(<?php echo $tableName; ?>);
                }

                return Collection(results);
            })
        };

        /**
        * Retrieve  a single <?php echo $tableName; ?> with attributes matching the current <?php echo $tableName; ?>.
        *
        * @returns {*}
        */
        var findOne = function()
        {
            var findAttributes = attributes;

            findAttributes['limit'] = 1;

            return doAJAX(
                'GET',
                '<?php echo $tablePlurals[$tableName]; ?>/?' + $.param(findAttributes)
            ).then(function(result) {

                if (result.data.length > 0) {
                    var <?php echo $tableName; ?> = <?php echo $tablePhpNames[$tableName]; ?>(result.data[0].Id);

                    for (var name in result.data[0]) {
                        if (result.data[0].hasOwnProperty(name)) {
                            var setter = "set" + name;

                            if (<?php echo $tableName; ?>.hasOwnProperty(setter)) {
                                <?php echo $tableName; ?>[setter](result.data[0][name]);
                            }
                        }
                    }

                    return <?php echo $tableName; ?>;
                } else {
                    return null;
                }

            })
        };

        /**
         * Perform the update or the create action for this <?php echo $tableName; ?>.
         *
         * @returns {*}
         */
        var save = function()
        {
            var <?php echo $tableName; ?> = this;

            var ajax;

            if (typeof getPk() === 'undefined') {
                ajax = doAJAX(
                    'POST',
                    '<?php echo $tablePlurals[$tableName]; ?>/',
                    attributes
                )
            } else {
                ajax = doAJAX(
                    'PUT',
                    path,
                    attributes
                )
            }

            return ajax.then(function(result) {attributes = result; return <?php echo $tableName; ?>;})
        };

        return {
            'get': get,
            'find': find,
            'findOne': findOne,
            'delete': remove,
            'save': save,
            'getPk': getPk,
<?php foreach ($columns as $columnName => $columnType) {?>
            'get<?=$columnName?>': get<?=$columnName?>,
            'set<?=$columnName?>': set<?=$columnName?>,
<?php } ?>
        }
    };
    <?php } ?>

    return function(data) {
        baseAddress = data.baseAddress;
        headers = data.headers;

        return {
            <?php foreach ($tablePlurals as $tableName => $pluralName) { ?>'<?php echo $pluralName; ?>': <?php echo $tablePhpNames[$tableName] ?>,
            <?php } ?>

        }
    };

})();

(function (document) {
    'use strict';

    var LightTableFilter = (function (Arr) {

        var _input;

        function _onInputEvent(e) {
            _input = e.target;
            var tables = document.getElementsByClassName(_input.getAttribute('data-table'));
            Arr.forEach.call(tables, function (table) {
                Arr.forEach.call(table.tBodies, function (tbody) {
                    Arr.forEach.call(tbody.rows, _filter);
                });
            });
        }

        function _filter(row) {
            var text = row.textContent.toLowerCase(), val = _input.value.toLowerCase();
            row.style.display = text.indexOf(val) === -1 ? 'none' : 'table-row';
        }

        return {
            init: function () {
                var inputs = document.getElementsByClassName('form-control');
                Arr.forEach.call(inputs, function (input) {
                    input.oninput = _onInputEvent;
                });
            }
        };
    })(Array.prototype);

    document.addEventListener('readystatechange', function () {
        if (document.readyState === 'complete') {
            LightTableFilter.init();
        }
    });

})(document);
$(document).ready(function () {
    $('[data-toggle="tooltip"]').tooltip();
    $.post("loadCombo.php", function (data) {
        $("#offCombo").empty();
        $("#offCombo").append("<option class='optoff' value='Select Offence'>Select Offence</option>")
        var new_data = JSON.parse(data);
        $.each(new_data, function (key, d) {
            var intent = "<option class='optoff' value='" + d + "'>" + d + "</option>";
            $("#offCombo").append(intent);
        });
    });
    $("#offCombo").change(function () {
        var desc = $("#offCombo").val();
         $.post("loadpenalty.php", {
            desc: desc
        }, function (data) {
            var new_data = JSON.parse(data);
            
            $("#penaltid").val(new_data);
            $("#penaltid2").val(new_data);
        });
    });
});
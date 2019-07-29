document.addEventListener('DOMContentLoaded', function () {
    var buttons = document.getElementsByClassName("jsbutton");
    for (i = 0; i < buttons.length; i++) {
        buttons[i].addEventListener('click', function () { doAction(this.id) });
    }

    var generator = document.getElementById('LicenseGenerate');
    if (typeof (generator) != 'undefined' && generator != null) {
        generator.addEventListener('click', LicenseGenerate);
    }

    var creator = document.getElementById('LicenseCreate');
    if (typeof (creator) != 'undefined' && creator != null) {
        creator.addEventListener('click', LicenseCreate);
    }

    var logdelete = document.getElementById('LogDelete');
    if (typeof (logdelete) != 'undefined' && logdelete != null) {
        logdelete.addEventListener('click', LogDelete);
    }
});

document.getElementById("idhead").textContent = "ID";
$("#checkAll").click(function () {
    $('input:checkbox').not(this).prop('checked', this.checked);
});

function getCheckedBoxes(chkboxName) {
    var checkboxes = document.getElementsByName(chkboxName);
    var checkboxesChecked = [];
    for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i].checked) {
            checkboxesChecked.push(checkboxes[i].value);
        }
    }
    return checkboxesChecked.length > 0 ? checkboxesChecked : null;
}

function doAction(value) {
    var checkedBoxes = getCheckedBoxes("box");
    if (checkedBoxes == null) return;
    var array = $.map(checkedBoxes, function (value, index) {
        return [value];
    });

    if (value == 'keydelete' || value == 'keyset') {
        $.confirm({
            theme: 'dark',
            title: 'Are you sure?',
            content: 'It can broke whole database!',
            buttons: {
                confirm: function () {
                    Continue(value, array);
                },
                cancel: function () {
                    return;
                }
            }
        });
    }
    else Continue(value, array);
}

function GetName(value) {
    if (value == 'ownerset') return 'Owner Name';
    if (value == 'typeset') return 'Product Name';
    if (value == 'hwidset') return 'HWID';
    if (value == 'keyset') return 'License Key';
    return '';
}

function Continue(value, array) {
    if (value == 'keyset' || value == 'hwidset' || value == 'ownerset' || value == 'typeset' || value == 'hwidset') {
        $.confirm({
            theme: 'dark',
            title: 'Enter New ' + GetName(value),
            content: '' +
                '<form action="" class="formName">' +
                '<div class="form-group">' +
                '<label></label>' +
                '<input type="text" placeholder="" class="text form-control" required />' +
                '</div>' +
                '</form>',
            buttons: {
                formSubmit: {
                    text: 'Submit',
                    btnClass: 'btn-blue',
                    action: function () {
                        var text = this.$content.find('.text').val();
                        if (!text) {

                            $.alert({
                                theme: 'dark',
                                title: 'It cannot be empty!',
                                content: ''
                            });
                            return false;
                        }
                        AjaxText(value, array, text);
                    }
                },
                cancel: function () {
                    return;
                },
            },
            onContentReady: function () {
                var jc = this;
                this.$content.find('form').on('submit', function (e) {
                    e.preventDefault();
                    jc.$$formSubmit.trigger('click');
                });
            }
        });
    }
    else AjaxNormal(value, array);
}

function AjaxNormal(value, array) {
    $.ajax({
        type: 'POST',
        url: 'php/ButtonsHandler.php',
        data: {
            action: value,
            box: array
        },
        success: function (data) {
            $.alert({
                theme: 'dark',
                title: data,
                content: ''
            });
            $("p").text(data);
        }
    });
}

function AjaxText(value, array, text) {
    $.ajax({
        type: 'POST',
        url: 'php/ButtonsHandler.php',
        data: {
            action: value,
            box: array,
            text: text
        },
        success: function (data) {
            $.alert({
                theme: 'dark',
                title: data,
                content: ''
            });
            $("p").text(data);
        }
    });
}

function SendToGenerator(count, type) {
    $.ajax({
        type: 'POST',
        url: 'php/InsertMultiHandler.php',
        data: {
            count: count,
            type: type
        },
        success: function (data) {
            $.alert({
                theme: 'dark',
                title: data,
                content: ''
            });
            $("p").text(data);
        }
    });
}

function LicenseGenerate() {
    $.confirm({
        theme: 'dark',
        title: 'Generator',
        content: '' +
            '<form action="" class="formName">' +
            '<div class="form-group">' +
            '<label>How many keys generate?</label>' +
            '<input type="text" placeholder="" class="count form-control" required />' +
            '<label>Product Name</label>' +
            '<input type="text" placeholder="" class="type form-control" required />' +
            '</div>' +
            '</form>',
        buttons: {
            formSubmit: {
                text: 'Submit',
                btnClass: 'btn-blue',
                action: function () {
                    var count = this.$content.find('.count').val();
                    if (!count) {
                        $.alert({
                            theme: 'dark',
                            title: 'It cannot be empty!',
                            content: ''
                        });
                        return false;
                    }
                    var isnum = /^\d+$/.test(count);
                    if (!isnum) {
                        $.alert({
                            theme: 'dark',
                            title: 'Only digits are allowed!',
                            content: ''
                        });
                        return false;
                    }
                    var type = this.$content.find('.type').val();
                    if (!type) {
                        $.alert({
                            theme: 'dark',
                            title: 'It cannot be empty!',
                            content: ''
                        });
                        return false;
                    }
                    SendToGenerator(count, type);
                }
            },
            cancel: function () {
            },
        },
        onContentReady: function () {
            var jc = this;
            this.$content.find('form').on('submit', function (e) {
                e.preventDefault();
                jc.$$formSubmit.trigger('click');
            });
        }
    });
}

function LicenseCreate() {
    $.confirm({
        theme: 'dark',
        title: 'Enter New License Keys',
        content: '' +
            '<form action="" class="formName">' +
            '<div class="form-group">' +
            '<label>If you want to use random keys use generator</label>' +
            '<input type="text" placeholder="Product Name" class="type form-control" required/><br />' +
            '<textarea type="text" placeholder="Keys" rows="10" class="keys form-control" required />' +
            '</textarea></div>' +
            '</form>',
        buttons: {
            formSubmit: {
                text: 'Submit',
                btnClass: 'btn-blue',
                action: function () {
                    var type = this.$content.find('.type').val();
                    if (!type) {
                        $.alert({
                            theme: 'dark',
                            title: 'It cannot be empty!',
                            content: ''
                        });
                        return false;
                    }
                    var keys = this.$content.find('.keys').val();
                    if (!keys) {
                        $.alert({
                            theme: 'dark',
                            title: 'It cannot be empty!',
                            content: ''
                        });
                        return false;
                    }
                    SendToInsert(type, keys);
                }
            },
            cancel: function () {
            },
        },
        onContentReady: function () {
            var jc = this;
            this.$content.find('form').on('submit', function (e) {
                e.preventDefault();
                jc.$$formSubmit.trigger('click');
            });
        }
    });
}

function SendToInsert(type, keys) {
    if (keys.replace(/(\r\n\t|\n|\r\t)/gm, "").length == 0) {
        $.alert({
            theme: 'dark',
            title: 'Incorrect keys!',
            content: ''
        });
        return;
    }
    $.ajax({
        type: 'POST',
        url: 'php/InsertMultiHandler.php',
        data: {
            type: type,
            keys: FixString(keys)
        },
        success: function (data) {
            $.alert({
                theme: 'dark',
                title: data,
                content: ''
            });
            $("p").text(data);
        }
    });
}

function FixString(str) {
    return str.replace(/\n/g, "\r\n$&");
}

function LogDelete() {
    var checkedBoxes = getCheckedBoxes('box');
    if (checkedBoxes == null) return;
    var array = $.map(checkedBoxes, function (value, index) {
        return [value];
    });
    $.ajax({
        type: 'POST',
        url: 'php/ButtonsHandler.php',
        data: {
            action: 'logdelete',
            box: array
        },
        success: function (data) {
            $.alert({
                theme: 'dark',
                title: data,
                content: ''
            });
            $('p').text(data);
        }
    });
}
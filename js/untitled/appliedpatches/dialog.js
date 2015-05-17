var UntitledAppliedPatches = {};
UntitledAppliedPatches.dialog = Class.create();

UntitledAppliedPatches.dialog.prototype = {

    //
    patchName: null,

    // Date the patch was either applied or reverted
    appliedRevertedOn: null,

    dialogWindow: null,

    initialize: function(patchName, appliedRevertedOnDate) {
        this.patchName = patchName;
        this.appliedRevertedOn = appliedRevertedOnDate;
    },

    openDialogWindow: function() {
        var content = this._getContent();

        this.dialogWindow = Dialog.info(content, {
            draggable: true,
            resizable: true,
            closable: true,
            className: "magento",
            windowClassName: "popup-window",
            title: 'Patch: ' + this.patchName,
            top: 50,
            width: 350,
            height: 350,
            zIndex: 1000,
            recenterAuto: false,
            hideEffect: Element.hide,
            showEffect: Element.show,
            id: "untitled-appliedpatches-dialog"
        });
    },

    _getContent: function() {
        return new Template(this._getMarkup()).evaluate({
            title: this.patchName,
            date: this.appliedRevertedOn
        });
    },

    _getMarkup: function() {
        var markup = "<h2>#{title}</h2>";
        return markup += "<div><strong>Applied On: </strong>#{date}</div>";
    }
};
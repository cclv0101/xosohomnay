function selectFileWithCKFinder(elementId, change) {
    CKFinder.modal({
        chooseFiles: true,
        width: 600,
        height: 400,
        onInit: function (finder) {
            finder.on('files:choose', function (evt) {
                var file = evt.data.files.first();
                var output = document.getElementById(elementId);
                output.value = file.getUrl();
                document.getElementById(change).src = file.getUrl();
            });
        }
    });
}
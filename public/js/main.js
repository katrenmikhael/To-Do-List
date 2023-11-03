const toastTrigger = document.getElementById("status");
const toastLiveExample = document.getElementById("liveToast");
const editBtn = document.getElementById("editBtn");
const deleteBtn = document.getElementById("deleteBtn");
const searchForm = document.getElementById("searchForm");
const searchText = document.getElementById("searchText");
if (toastTrigger.innerHTML != "") {
    const toast = new bootstrap.Toast(toastLiveExample);

    toast.show();
}
function editTask(id) {
    var url = `/tasks/${id}`;
    editBtn.setAttribute("formaction", url);
}
function deleteTask(id) {
    var url = `/tasks/delete/${id}`;
    deleteBtn.setAttribute("formaction", url);
}
searchText.addEventListener("keydown", function () {
    searchForm.submit();
});

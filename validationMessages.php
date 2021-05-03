<?php
if (isset($_GET['empty'])) {
    echo '<div class="alert alert-warning alert-dismissible" role="alert">
    <strong>ERROR !</strong> Data field remained empty. Fill up the field and try again.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
}
if (isset($_GET['success'])) {
    echo '<div class="alert alert-success alert-dismissible" role="alert">
    <strong>SUCCESSFUL !</strong> Data has been inserted successfully.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
}
if (isset($_GET['updated'])) {
    echo '<div class="alert alert-info alert-dismissible" role="alert">
    <strong>UPDATED !</strong> Data has been updated successfully.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
}
    if (isset($_GET['not-updated'])) {
        echo '<div class="alert alert-warning alert-dismissible" role="alert">
    <strong>NOT UPDATED !</strong> Data has not been updated.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }
if (isset($_GET['deleted'])) {
    echo '<div class="alert alert-danger alert-dismissible" role="alert">
    <strong>DELETED !</strong> Data has been deleted successfully.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
}
?>


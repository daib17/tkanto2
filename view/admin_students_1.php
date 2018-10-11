<div class="main-container">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" href="?route=admin_students_1">Students</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="?route=admin_bookings">Bookings</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="?route=admin_planning_1">Planning</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="?route=admin_stats">Statistics</a>
        </li>
    </ul>
    <div class="container main-container-inner">
        <div class="spinner">
            <?= $select ?>
        </div>
        <table class="table table-bordered table-selectable">
            <thead>
                <tr>
                    <th scope="col" colspan="2">Name</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                <?= $studentTable ?>
            </tbody>
        </table>
        <?= $pagination ?>
        <!-- Debug: <?= $studentID ?> -->
        <div class="<?= $infoMsg ?>">
            <div class="alert alert-info" role="alert">
                Select student to edit details.
            </div>
        </div>
        <form class="top-buffer" method="get">
            <input type='hidden' name='route' value='admin_students_2'>
            <input type="hidden" name="studentID" value="<?= $studentID ?>">
            <button class="btn btn-lg btn-primary btn-block font-weight-bold <?= $editButton ?>" type="submit" name="button" value="edit">Edit</button>
        </form>
    </div>
</div>
<script type="text/javascript" src="js/teacher.js"></script>

<script type="text/javascript" src="js/query.js"></script>
<div class="main-container">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link" href="?route=admin_calendar_1">Calendar</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="?route=admin_students_1">Students</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="?route=admin_recent">Recent</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="?route=admin_stats">Statistics</a>
        </li>
    </ul>
    <div class="container main-container-inner">
        <form>
            <div class="float-right input-group w-50 mb-3">
                <input class="form-control" type="text" placeholder="Search" name="search">
                <div class="input-group-append">
                    <input type="hidden" name="route" value="admin_students_1">
                    <button type="submit" class="btn btn-info">
                        <i class="fa fa-search" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
        </form>
        <div class="spinner">
            <?= $select ?>
        </div>


        <script>getStudentTable();</script>
        <span id="output">Loading...</span>

        <form class="top-buffer" method="get">
            <input type='hidden' name='route' value='admin_students_2'>
            <button class="btn btn-lg btn-info btn-block font-weight-bold" type="submit" name="button" value="edit">Edit</button>
        </form>
    </div>
</div>
<script type="text/javascript" src="js/admin_stats.js"></script>

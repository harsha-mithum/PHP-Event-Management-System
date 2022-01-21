<?php
require_once 'assets/php/user-header.php';
$user = new Auth();
?>


<?php
$event = $user->fetchEventDetailsByUser($cid);
echo $cid;
if ($event) {

    foreach ($event as $data) {

        $id = $data['id'];
        $title = $data['title'];
        $location = $data['location'];
        $date = $data['start_date'];
        $time = $data['time'];
        $guest = $data['people'];
        $type = $data['type'];
        $package = $data['package'];
        $cameramen = $data['cameramen'];
        $user_id = $data['user_id'];
        $user_name = $data['user_name'];
        $user_address = $data['user_address'];
        $user_phone = $data['user_phone'];
        $user_email = $data['user_email'];

?>
        <div class="page-werapper">
            <div class="col-sm-12 border rounded m-3 p-5 bg-white shadow" id="eventDetails">
                <div class="row">
                    <div class="col-6">
                        <h4 class="mb-5">Event Details</h4>
                        <dl class="row">
                            <dt class="col-sm-4">Title</dt>
                            <dd class="col-sm-8">
                                <p id="etitle"><?= $title; ?></p>
                            </dd>

                            <dt class="col-sm-4">Location</dt>
                            <dd class="col-sm-8">
                                <p id="elocation"><?= $location; ?></p>
                            </dd>

                            <dt class="col-sm-4">Event Date</dt>
                            <dd class="col-sm-8">
                                <p id="edate"><?= $date; ?></p>
                            </dd>

                            <dt class="col-sm-4">Event Time</dt>
                            <dd class="col-sm-8">
                                <p id="etime"><?= $time; ?></p>
                            </dd>

                            <dt class="col-sm-4">Guest Count</dt>
                            <dd class="col-sm-8">
                                <p id="eguest"><?= $guest; ?></p>
                            </dd>
                        </dl>
                    </div>
                    <div class="col-6">
                        <h4 class="mb-5">Event Details</h4>
                        <dl class="row">
                            <dt class="col-sm-4">Event Type</dt>
                            <dd class="col-sm-8">
                                <p id="etype"><?= $type; ?></p>
                            </dd>

                            <dt class="col-sm-4">Package</dt>
                            <dd class="col-sm-8">
                                <p id="epackage"><?= $package; ?></p>
                            </dd>

                            <dt class="col-sm-4">Cameramen</dt>
                            <dd class="col-sm-8">
                                <p id="edate"><?= $cameramen; ?></p>
                            </dd>

                        </dl>
                    </div>
                </div>
            </div>
        </div>
<hr>
<?php
    }
} else {
    echo '<div class="page-wrapper"><div class="p-5"><h1 class="mt-5 text-center">No Event Details Available!</h1> </div></div>';
}
?>
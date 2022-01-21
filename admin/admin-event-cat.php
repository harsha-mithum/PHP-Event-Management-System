<!-- Event Type -->
<div class="row justify-content-center">
    <div class="col-sm-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title text-center">Event Types</h4>
            </div>
            <div class="card-body">

                <div class="table-responsive" id="showAllTypes">
                    <h4 class="text-center text-lead mt-2">Please Wait...</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-5 col-md-4 col-lg-3">
        <div class="card" id="createEventType">
            <div class="card-header">
                <h4 class="card-title text-center">Add Event Type</h4>
            </div>
            <div class="card-body">
                <form action="" id="type-create-form">
                    <div class="form-group">
                        <label class="control-label">Select a Event Category</label>
                        <select class="custom-select" id="" name="event_cat" required>
                            <?php foreach ($count->fetchAllCat() as $row) {
                                $id = $row['id'];
                                $name = $row['name'];
                                echo "<option value=$id>$name</option>";
                            } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="typeName">Event Type</label>
                        <input type="text" class="form-control" id="typeName" name="typeName" required>
                    </div>
                    <div class="modal-footer form-group">
                        <button type="submit" name="createBtn" id="createBtn" class="btn btn-block btn-primary">Add<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;" id="create-type-spinner"></span></button>
                        <button type="reset" class="btn btn-secondary" name="resetBtn" id="resetBtn">Clear</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card" id="editEventType">
            <div class="card-header">
                <h4 class="card-title text-center">Edit Event Type</h4>
            </div>
            <div class="card-body">
                <form action="" id="type-update-form">
                    <input type="hidden" name="editTypeID" id="editTypeID">
                    <div class="form-group">
                        <label class="control-label">Select a Event Category</label>
                        <select class="custom-select" id="editEventTypeCat" name="edit_event_cat" required>
                            <?php foreach ($count->fetchAllCat() as $row) {
                                $id = $row['id'];
                                $name = $row['name'];
                                echo "<option value=$id>$name</option>";
                            } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="typeName">Event Type</label>
                        <input type="text" class="form-control" id="editTypeName" name="editTypeName" required>
                    </div>
                    <div class="modal-footer form-group">
                        <button type="submit" name="updateBtn" id="updateBtn" class="btn btn-block btn-primary">Update<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;" id="update-type-spinner"></span></button>
                        <button type="reset" class="btn btn-secondary" name="resetBtn" id="resetBtn" onclick="$('#editEventType').hide();$('#createEventType').show();">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<!-- Event Category -->

<div class="mb-5">
    <hr>
</div>

<div class="row justify-content-center">


    <div class="col-sm-5 col-md-4 col-lg-3">
        <div class="card" id="createEventCat">
            <div class="card-header">
                <h4 class="card-title text-center">Add Event Category</h4>
            </div>
            <div class="card-body">
                <form action="" id="cat-create-form">
                    <div class="form-group">
                        <label for="catName">Event Category</label>
                        <input type="text" class="form-control" id="catName" name="catName" required>
                    </div>
                    <div class="modal-footer form-group">
                        <button type="submit" name="createBtn" id="createBtn" class="btn btn-block btn-primary">Add<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;" id="create-cat-spinner"></span></button>
                        <button type="reset" class="btn btn-secondary" name="resetBtn" id="resetBtn">Clear</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card" id="editEventCat">
            <div class="card-header">
                <h4 class="card-title text-center">Edit Event Category</h4>
            </div>
            <div class="card-body">
                <form action="" id="cat-update-form">
                    <input type="hidden" name="editCatID" id="editCatID">
                    <div class="form-group">
                        <label for="catName">Event Category</label>
                        <input type="text" class="form-control" id="editCatName" name="editCatName" required>
                    </div>
                    <div class="modal-footer form-group">
                        <button type="submit" name="updateBtn" id="updateBtn" class="btn btn-block btn-primary">Update<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;" id="update-cat-spinner"></span></button>
                        <button type="reset" class="btn btn-secondary" name="resetBtn" id="resetBtn" onclick="$('#editEventCat').hide();$('#createEventCat').show();">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title text-center">Event Category</h4>
            </div>
            <div class="card-body">

                <div class="table-responsive" id="showAllCat">
                    <h4 class="text-center text-lead mt-2">Please Wait...</h4>
                </div>
            </div>
        </div>
    </div>
</div>
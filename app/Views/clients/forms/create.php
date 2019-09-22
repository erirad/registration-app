<h1>Customer registration</h1>

<form method="post" action="/clients/store">
    <div class="form-group">
        <input
                type="text"
                name="name"
                class="form-control"
                aria-describedby="inputHelp"
                placeholder="Tom"
                value="<?php echo isset($_POST['name']) ? $_POST['name'] : '' ?>"
        >
        <small id="inputHelp" class="form-text text-muted">* enter a name</small>
    </div>
    <div class="form-group">
        <select class="form-control" name="consultant" aria-describedby="consultantHelp">
            <?php foreach ($data['consultants'] as $consultant) { ?>
                <option value="<?php echo $consultant['id']; ?>">
                    <?php echo $consultant['name']; ?>
                </option>
            <?php } ?>
        </select>
        <small id="consultantHelp" class="form-text text-muted">
            * choose a consultant
        </small>
    </div>
    <button type="submit" class="btn btn-primary">Register</button>
</form>

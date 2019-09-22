<form method="get" action="/clients/selectConsultantStatistic" class="m-5">
    <div class="row float-right">
        <div class="form-group">
            <select class="form-control" name="consultant" aria-describedby="selectHelp">
                <?php foreach ($data['consultants'] as $consultant) { ?>
                    <option value="<?php echo $consultant['id']; ?>"><?php echo $consultant['name']; ?></option>
                <?php } ?>
            </select>
            <small id="selectHelp" class="form-text text-muted">*Filter by specialist</small>
        </div>
        <button type="submit" class="btn btn-primary btn-height">Filter</button>
    </div>
</form>
<h1><?php echo isset($_GET['consultant']) ? $data['consult']['name'] . ' ' : '' ?>statistic</h1>
<table class="table">
    <thead>
    <tr>
        <th scope="col">Date</th>
        <th scope="col">Hour</th>
        <th scope="col">Number of clients</th>
    </tr>
    </thead>
    <tbody>
    <?php $date = null; ?>
    <?php foreach ($data['clients'] as $key => $client) { ?>
        <tr>
            <?php if ($date != $client['DATE(created_at)']) { ?>
                <td><b><?php echo $client['DATE(created_at)']; ?></b></td>
            <?php } else { ?>
                <td></td>
            <?php } ?>
            <td><i><?php echo $client['HOUR(created_at)']; ?>:00 - <?php echo $client['HOUR(created_at)'] + 1; ?>:00</i>
            </td>
            <td><?php echo $client['COUNT(id)']; ?></td>
        </tr>
        <?php $date = $client['DATE(created_at)']; ?>
    <?php } ?>
    </tbody>
</table>

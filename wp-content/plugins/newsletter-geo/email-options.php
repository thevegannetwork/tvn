<?php
$list = $wpdb->get_results("select country, count(*) as total from " . NEWSLETTER_USERS_TABLE . " where status='C' and country<>'' group by country order by country");

$countries = array();
foreach ($list as $item) {
    if (empty($item->country)) continue;
    if (empty($controls->countries[$item->country])) $countries[$item->country] = $item->country . ' (' . $item->total . ')';
    else $countries[$item->country] = $controls->countries[$item->country] . ' (' . $item->total . ')';
}

$list = $wpdb->get_results("select region, count(*) as total from " . NEWSLETTER_USERS_TABLE . " where status='C' and region<>'' group by region order by region");

$regions = array();
foreach ($list as $item) {
    if (empty($item->region)) continue;
    $regions[$item->region] = $item->region . ' (' . $item->total . ')';
}
?>

<table class="form-table">
    <tr valign="top">
        <th>Country</th>
        <td>
            <?php $controls->select2('options_countries', $countries, null, true); ?>
            <p class="description">Some country codes could have no meaning. Not all subscribers are resolved.</p>
        </td>
    </tr>
    <tr valign="top">
        <th>Regions</th>
        <td>
            <?php $controls->select2('options_regions', $regions, null, true); ?>
        </td>
    </tr>
</table>

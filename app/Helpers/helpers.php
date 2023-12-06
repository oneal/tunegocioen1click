<?php

function generateSlug($cadena, $delimiter = '-')
{
    $slug = strtolower(trim(preg_replace('~[^0-9a-z]+~i', $delimiter, html_entity_decode(preg_replace('~&([a-z]{1,2})(?:acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i', '$1', htmlentities($cadena, ENT_QUOTES, 'UTF-8')), ENT_QUOTES, 'UTF-8')), $delimiter));
    return $slug;
}

function textRich($text)
{
    return strip_tags($text, '<p><strong><b><h1><h2><h3><h4><h5><h6><a><ul><li><ol><img><table><th><tr><td><colgroup><col><tbody><span><em>');
}

function statusAnounce($position)
{
    $date_now = new DateTime(date('Y-m-d'));
    $date_end = isset($position->date_end) ? new DateTime($position->date_end) : null;
    $paid = "";
    if(isset($position)) {
        if(isset($position->date_end) && $date_end->diff($date_now)->days <= 30 ) {
            $alert = "alert-danger";
        } else {
            $alert = "alert-success";
        }

        if(isset($position->invoice) && $position->invoice->paid == 1) {
            $paid = "Pagado";
        } else if(isset($position->invoice) && $position->invoice->paid == 0) {
            $paid = "No pagado";
            $alert = "alert-warning";
        } else{
            $paid = "Sin Factura";
        }
    } else {
        $alert = "alert-info";
    }

    $result['alert'] = $alert;
    $result['paid'] = $paid;

    return $result;
}

function getSeo($type)
{
    $seoMeta = \App\Models\SeoMeta::where('seo_type_id', 1)->first();
    $title = setting('site.title');
    $description = setting('site.description');
    if(isset($seoMeta)){
        $title = $seoMeta->title;
        $description = $seoMeta->description;
    }

    $data['title'] = $title;
    $data['description'] = $description;

    return $data;
}

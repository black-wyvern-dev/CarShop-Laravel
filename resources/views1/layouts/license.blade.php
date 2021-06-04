<!doctype html>
<html>
<head>
    <link rel="shortcut icon" href="{{ asset('/img/favicon.png') }}" type="image/x-icon">
    {!!
        Minify::stylesheet([
            '/css/bootstrap.min.css',
            '/css/font-awesome.css',
            '/css/license.css',
         ])->withFullUrl()
    !!}
    <title> {{$sale->item->name}} License | Alkanyx Marketplace </title>
</head>
@yield('head')
<body>

<div class="container">

    <h2><img class="brand-logo" src="{{asset('/img/alkanyx-logo.png')}}"> {{ __('Alkanyx Marketplace License') }}</h2>

    <p>{{ __('This license is between the author of the Item and you - the buyer. Alkanyx, represented by Qdev Techs SRL is not a party to this license or the one giving you the license.') }}</p>

    <h3>{{ __('License details') }}</h3>
    <ul>
        <li>{{ __('Item author: :fname :lname', ['fname' => $sale->seller->fname, 'lname' => $sale->seller->lname]) }}</li>
        <li>{{ __('Item name: :name',           ['name' => $sale->item->name]) }}</li>
        <li>{{ __('Buyer: :fname :lname',       ['fname' => $sale->buyer->fname, 'lname' => $sale->buyer->lname]) }}</li>
        <li>{{ __('License type: :type',        ['type' => config('ak2app.licenses')[$sale->item->license]['name']]) }}</li>
        <li>{{ __('Item support: :support',     ['support' => $support ? 'Listing' : 'No support offered']) }}</li>
        <li>{{ __('Purchase date: :date',       ['date' => date("d/m/Y", strtotime($sale->dateAdded))]) }}</li>
        <li>{{ __('License key:') }} <code>{{$sale->licenseCode}}</code></li>
    </ul>

    <h3>{{ __('License limits') }}</h3>
    <p>{{ __('Deppending on the type of license you have purchased the limits apply as below.') }}</p>
    <h4> {{ __('Personal License') }}</h4>
    <ul>
        <li>{{ __('As a buyer, this license grants you, an ongoing, non-exclusive, worldwide license to make use of the digital work (Item) you have purchased.') }}</li>
        <li>{{ __('You') }} <b>{{ __('can’t sell the End Product') }}</b>, except to one client. If you or your client want to Sell the End Product, you will need the Extended License.</li>
        <li>{{ __('You are licensed to use the Item to create') }} <b>{{ __('one Single End Product') }}</b> {{ __('for yourself or for one client, and the product can be distributed for free.') }}</li>
        <li>{{ __('You') }} <b>{{ __('can’t re-distribute the Item') }}</b> {{ __('as stock, in a tool or template, or with source files. You can’t do this with an Item either on its own or bundled with other items, and even if you modify the Item. You can’t re-distribute or make available the Item as-is or with superficial modifications. These things are not allowed even if the re-distribution is for Free.') }}</li>
    </ul>


    <h4> {{ __('Commercial License') }}</h4>
    <ul>
        <li>{{ __('As a buyer, the Extended License grants you, an ongoing, non-exclusive, worldwide license to make use of the digital work (Item) you have purchased.') }}</li>
        <li>{{ __('You are licensed to use the Item to create') }} <b>{{ __('multiple End Products') }}</b> {{ __('for yourself or for one client, and') }} <b>{{ __('the End Product may be sold.') }}</b></lI>
        <li>{{ __('You can create the End Product for a client, and this license is then transferred from you to your client.') }}</li>
        <li>{{ __('You') }} <b>{{ __('can’t re-distribute the Item') }}</b> {{ __('as stock, however if you either if you substantially modify it, extend its functionality or make it part of a bigger project, you then can re-distribute the item.') }}</li>
    </ul>

    <p><i>{{ __('We try to keep the license terms as simple as possible, however, don\'t forget that this is a legal document though, with real life implications.') }}</i></p>

    <hr>
    <p class="pull-right">{{ __('Alkanyx Digital marketplace © Qdev Techs SRL All rights reserved - :date', ['date' => date('Y')]) }}</p>

</div>



</body>
</html>

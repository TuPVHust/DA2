@extends('layouts.boss')
@section('title')
    AdminLTE 3 | Tracking
@endsection
@section('css')
    {{-- datatables --}}
    {{-- <link rel="stylesheet" href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css"> --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.11.3/datatables.min.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
        integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
        crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
        integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
        crossorigin=""></script>
    <style>
        #map {
            height: 100%;
        }

    </style>
@endsection
@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('boss.dashboard') }}">Home</a></li>
        <li class="breadcrumb-item active">Tracking</li>
    </ol>
@endsection
@section('content')
    <div class="row">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Bản đồ</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <div class="d-md-flex p-0">
                    <div class="p-0 flex-fill" style="overflow: hidden">
                        <!-- Map will be created here -->
                        <div id="world-map-markers" style="height: 450px; overflow: hidden">
                            <div id="map"></div>
                        </div>
                    </div>
                    <div class="card-pane-right bg-light pt-2 pb-2 pl-4 pr-4">
                        @livewire('tracking')
                        <!-- /.description-block -->
                    </div><!-- /.card-pane-right -->
                </div><!-- /.d-md-flex -->
            </div>
            <!-- /.card-body -->
        </div>
    </div>
@endsection

@section('js')
    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script>
        var map = L.map('map').setView([20.8175668, 105.7439194], 7);
        //alert('oki');
        var osm = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        });
        osm.addTo(map);
        var markers = new Array();
        var circles = new Array();
        Livewire.on('updateMap', (positionInfo) => {
            //var map = L.map('map').setView([14.0860746, 100.608406], 10);
            //osm.addTo(map);
            //console.log(positionInfo);
            for (var i = 0; i < this.markers.length; i++) {
                map.removeLayer(markers[i]);
            }
            for (var i = 0; i < this.circles.length; i++) {
                map.removeLayer(circles[i]);
            }
            circles = []
            markers = []
            for (const iterator in positionInfo) {
                //console.log(positionInfo[iterator]['lat']);
                var marker, circle;
                // if (marker) {
                //     map.removeLayer(marker)
                // }

                // if (circle) {
                //     map.removeLayer(circle)
                // }

                marker = new L.marker([positionInfo[iterator]['lat'], positionInfo[iterator]['lng']]).bindPopup(
                    iterator)
                circle = new L.circle([positionInfo[iterator]['lat'], positionInfo[iterator]['lng']], {
                    radius: 100
                })
                markers.push(marker);
                circles.push(circle);
            }
            //console.log(markers[0]);
            for (var i = 0; i < markers.length; i++) {
                var featureGroup = L.featureGroup([markers[i], circles[i]]).addTo(map)
                //map.fitBounds(featureGroup.getBounds())
            }
        })

        function flyToLatLng(lat, lng) {
            //alert(lng);
            map.flyTo([lat, lng], 10);
        };
    </script>

    <script>
        $(document).ready(function() {
            //alert('oki');
            Livewire.emit('askForPositionInfo');
        });
    </script>
@endsection

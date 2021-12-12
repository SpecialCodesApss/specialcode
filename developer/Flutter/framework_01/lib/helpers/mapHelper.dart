import 'dart:async';
import 'package:flutter/material.dart';
import '../packages/flutter_map_picker/lib/flutter_map_picker.dart';
import 'package:google_maps_flutter/google_maps_flutter.dart';

class Map extends StatefulWidget {
  @override
  _MapState createState() => _MapState();
}

class _MapState extends State<Map> {
  LatLng DEFAULT_LAT_LNG = LatLng(30.0, 31.0); //Egypt
  String GOOGLE_PLACES_API_KEY = "AIzaSyAXqchezj3lXzwZAQxDSt8cxKdBXllFtOQ";

  @override
  void initState() {
    super.initState();

    Timer.run(() {
      Navigator.pushReplacement(
          context,
          MaterialPageRoute(
              builder: (context) => PlacePickerScreen(
                    googlePlacesApiKey: GOOGLE_PLACES_API_KEY,
                    initialPosition: DEFAULT_LAT_LNG,
                    mainColor: Theme.of(context).primaryColor,
                    mapStrings: MapPickerStrings.english(),
                    placeAutoCompleteLanguage: 'ar',
                  )));
    });
  }

  @override
  Widget build(BuildContext context) {
    // TODO: implement build
    return Scaffold();
  }
}

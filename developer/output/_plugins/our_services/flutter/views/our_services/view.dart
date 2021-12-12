
        import 'package:flutter_widget_from_html/flutter_widget_from_html.dart';

import '../../Controllers/Our_serviceController.dart';
import '../../helpers/LoaderDialog.dart';
import '../../helpers/ToastHelper.dart';
import 'package:framework_01_6/helpers/LanguageHelper.dart' as LanguageHelper;
import '../../lang/ar/our_services.dart' as messages_ar;
import '../../lang/en/our_services.dart' as messages_en;
import '../../main.dart';
import '../../helpers/SizeConfig.dart';
import 'package:flutter/widgets.dart';
import 'package:flutter/material.dart';
import '../Home.dart';
import 'package:carousel_slider/carousel_slider.dart';

import '../../Views/our_services/index.dart';



class Our_servicesView extends StatefulWidget {

  final int id;
  Our_servicesView(this.id, {Key key}) : super(key: key);

  @override
  State<StatefulWidget> createState() {
    // TODO: implement createState
    return _Our_servicesViewState();
  }
}

class _Our_servicesViewState extends State<Our_servicesView>{
  //declare variables here
var language = LanguageHelper.Language;
    final List<String> imgList = [];
    bool ViewImage = true;
    String ViewedImageType = "slider";
  var data;

  Our_serviceController _Our_serviceController = new Our_serviceController();
  read() async {
    //get  data
    Future.delayed(Duration.zero, () => showLoaderDialogFunction(context));
    _Our_serviceController.view(widget.id).whenComplete((){
      if(_Our_serviceController.status == true){
        setState(() {
          data = _Our_serviceController.data;
            // if(ViewImage){
            //     if(ViewedImageType=="slider"){
            //       var images=data["data"]["images"];
            //       images.forEach((image) async {
            //         imgList.add("http://192.168.1.101/framework/"+image["image"]);
            //       });
            //     }
            //     else{
            //         if(data["data"]["our_service_image"] != null){
            //           imgList.add("http://192.168.1.101/framework/" + data["data"]["our_service_image"]);
            //         }
            //     }
            // }
        });
        Future.delayed(Duration.zero, () => hideLoaderDialogFunction(context));
      }else{
        ShowToast('warning',_Our_serviceController.message);
        Future.delayed(Duration.zero, () => hideLoaderDialogFunction(context));
      }
    });
  }
  
  

 
  @override
  void initState() {
    // TODO: implement initState
    super.initState();
    read();
  }
  @override
  void dispose() {
    // TODO: implement dispose
    super.dispose();
  }

  @override
  Widget build(BuildContext context) {
    // TODO: implement build
    SizeConfig().init(context); // for media query
    var screenWidthRatio = 10;
    var screenHightRatio = 35;
    var contenttopalignmentratio=20;
    if(SizeConfig.orientation == Orientation.landscape){
      screenWidthRatio = 20 ;
      screenHightRatio = 55 ;

      contenttopalignmentratio=10;
    }
    else{
      screenWidthRatio = 10 ;
      screenHightRatio = 35 ;

      contenttopalignmentratio=3;
    }


   return Scaffold(
      appBar: AppBar(
        title:Text(
        language =="en" ? messages_en.getTranslation("Our_services") : messages_ar.getTranslation
                                      ("Our_services"),
          style: Theme.of(context).textTheme.title,
        ),
        centerTitle: true,
        leading: IconButton(icon:Icon(Icons.arrow_back),
        onPressed:() => Navigator.of(context).push(
        MaterialPageRoute(builder: (context) => Our_servicesIndex())
        ),
        ),
      ),

        body: Container(
            child: data != null ? ListView(
              padding: EdgeInsets.all(10.0),
                children: <Widget>[
                  Image.network("http://192.168.1.101/framework/" +data["data"]["image"]
                  , fit: BoxFit.cover, width: 1000),
                  Text(
                    language =="en" ? data["data"]["name_en"] :
                    data["data"]["name_ar"],
                    style: Theme.of(context).textTheme.body1,
                    textAlign: TextAlign.center,
                  ),

                  // Padding(
                  // padding: EdgeInsets.only(top:20.0,right: 0.0),
                  // child:Directionality(
                  //   textDirection: language =="ar" ? TextDirection.rtl : TextDirection.ltr,
                  //   child: Text(
                  //     language =="en" ? messages_en.getTranslation("description_html_ar") :
                  //     messages_ar.getTranslation("description_html_ar"),
                  //     style: TextStyle(fontWeight: FontWeight.bold),
                  //     textDirection: language =="ar" ? TextDirection.rtl : TextDirection.ltr,
                  //   ),
                  // )
                  // ),

                      language =="en" ?
                          HtmlWidget(data["data"]["description_html_en"]) :
                      HtmlWidget(data["data"]["description_html_ar"]),



            //
            // Padding(
            //           padding: EdgeInsets.only(top:50.0,left: 30.0,right: 30.0),
            //           child: RaisedButton(
            //               color: Theme.of(context).primaryColor ,
            //               child:  Text(
            //                 language =="en" ? messages_en.getTranslation("order") : messages_ar.getTranslation("order"),
            //                 style: Theme.of(context).textTheme.button,
            //               ),
            //               onPressed: null
            //           ),
            //       ),

                ],
              ): null ,
            )
    );
  }
}

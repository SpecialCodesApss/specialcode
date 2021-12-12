
        import '../../Controllers/News_autherController.dart';
import '../../helpers/LoaderDialog.dart';
import '../../helpers/ToastHelper.dart';
import 'package:framework_01_6/helpers/LanguageHelper.dart' as LanguageHelper;
import '../../lang/ar/news_authers.dart' as messages_ar;
import '../../lang/en/news_authers.dart' as messages_en;
import '../../main.dart';
import '../../helpers/SizeConfig.dart';
import 'package:flutter/widgets.dart';
import 'package:flutter/material.dart';
import '../Home.dart';
import 'package:carousel_slider/carousel_slider.dart';

import '../../Views/news_authers/index.dart';


class News_authersView extends StatefulWidget {

  final int id;
  News_authersView(this.id, {Key key}) : super(key: key);

  @override
  State<StatefulWidget> createState() {
    // TODO: implement createState
    return _News_authersViewState();
  }
}

class _News_authersViewState extends State<News_authersView>{
  //declare variables here
var language = LanguageHelper.Language;
    final List<String> imgList = [];
    bool ViewImage = true;
    String ViewedImageType = "image";
  var data;

  News_autherController _News_autherController = new News_autherController();
  read() async {
    //get  data
    Future.delayed(Duration.zero, () => showLoaderDialogFunction(context));
    _News_autherController.view(widget.id).whenComplete((){
      if(_News_autherController.status == true){
        setState(() {
          data = _News_autherController.data;
            if(ViewImage){
                if(ViewedImageType=="slider"){
                  var images=data["data"]["images"];
                  images.forEach((image) async {
                    imgList.add("http://192.168.0.101/framework/"+image["profile_image"]);
                  });
                }
                else{
                    if(data["data"]["profile_image"] != null){
                      imgList.add("http://192.168.0.101/framework/" + data["data"]["profile_image"]);
                    }
                }
            }
        });
        Future.delayed(Duration.zero, () => hideLoaderDialogFunction(context));
      }else{
        ShowToast('warning',_News_autherController.message);
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
        language =="en" ? messages_en.getTranslation("News_authers") : messages_ar.getTranslation
                                      ("News_authers"),
          style: Theme.of(context).textTheme.title,
        ),
        centerTitle: true,
        leading: IconButton(icon:Icon(Icons.arrow_back),
        onPressed:() => Navigator.of(context).push(
        MaterialPageRoute(builder: (context) => News_authersIndex())
        ),
        ),
      ),

        body: Container(
            child: data != null ? ListView(
              padding: EdgeInsets.all(5.0),
                children: <Widget>[
                  ViewImage==true ? CarouselSlider(
                    options:  CarouselOptions(
                      viewportFraction: 1.0,
                      enlargeCenterPage: false,
                      autoPlay: ViewedImageType=="slider" ? false : false,
                      autoPlayInterval: Duration(seconds: 3),
                    ),
                    items: imgList.map((item) => Container(
                      child: Center(
                          child: Image.network(item, fit: BoxFit.cover, width: 1000)
                      ),
                    )).toList(),
                  ) : SizedBox(),
                  Text(
                    language =="en" ? messages_en.getTranslation("profile_image") : messages_ar.getTranslation("profile_image"),
                    style: Theme.of(context).textTheme.body1,
                    textAlign: TextAlign.center,
                  ),

                  Padding(
                  padding: EdgeInsets.only(top:20.0,right: 0.0),
                  child:Directionality(
                    textDirection: language =="ar" ? TextDirection.rtl : TextDirection.ltr,
                    child: Text(
                      language =="en" ? messages_en.getTranslation("name_ar") : messages_ar.getTranslation("name_ar"),
                      style: TextStyle(fontWeight: FontWeight.bold),
                      textDirection: language =="ar" ? TextDirection.rtl : TextDirection.ltr,
                    ),
                  )
                  ),
                  Text(
                      data["data"]["name_ar"].toString()+language =="en" ? messages_en.getTranslation("SARcurrency") : messages_ar.getTranslation("SARcurrency")
                  ),

                  Table(
                      children:[
                        TableRow(
                            children: [
                              Text(
                                language =="en" ? messages_en.getTranslation("Biographical_info_ar") : messages_ar.getTranslation
                                                                                    ("Biographical_info_ar"),
                                style: TextStyle(fontWeight: FontWeight.bold),
                              ),
                              Text(
                                  data["data"]["Biographical_info_ar"].toString()
                              ),
                            ]
                        ),
                        TableRow(
                            children: [
                              Text(
                                language =="en" ? messages_en.getTranslation("email") : messages_ar.getTranslation("email"),
                                style: TextStyle(fontWeight: FontWeight.bold),
                              ),
                              Text(
                                  data["data"]["email"].toString()
                              ),
                            ]
                        ),
                        TableRow(
                            children: [
                              Text(
                                language =="en" ? messages_en.getTranslation("facebook") : messages_ar.getTranslation("facebook"),
                                style: TextStyle(fontWeight: FontWeight.bold),
                              ),
                              Text(
                                  data["data"]["facebook"].toString()
                              ),
                            ]
                        ),

                      ]
                  ),



                ],
              ): null ,
            )
    );
  }
}


        import '../../Controllers/News_newspaper_publisherController.dart';
import '../../helpers/LoaderDialog.dart';
import '../../helpers/ToastHelper.dart';
import 'package:framework_01_6/helpers/LanguageHelper.dart' as LanguageHelper;
import '../../lang/ar/news_newspaper_publishers.dart' as messages_ar;
import '../../lang/en/news_newspaper_publishers.dart' as messages_en;
import '../../main.dart';
import '../../helpers/SizeConfig.dart';
import 'package:flutter/widgets.dart';
import 'package:flutter/material.dart';
import '../Home.dart';
import 'package:carousel_slider/carousel_slider.dart';

import '../../Views/news_newspaper_publishers/index.dart';



class News_newspaper_publishersView extends StatefulWidget {

  final int id;
  News_newspaper_publishersView(this.id, {Key key}) : super(key: key);

  @override
  State<StatefulWidget> createState() {
    // TODO: implement createState
    return _News_newspaper_publishersViewState();
  }
}

class _News_newspaper_publishersViewState extends State<News_newspaper_publishersView>{
  //declare variables here
var language = LanguageHelper.Language;
    final List<String> imgList = [];
    bool ViewImage = true;
    String ViewedImageType = "image";
  var data;

  News_newspaper_publisherController _News_newspaper_publisherController = new News_newspaper_publisherController();
  read() async {
    //get  data
    Future.delayed(Duration.zero, () => showLoaderDialogFunction(context));
    _News_newspaper_publisherController.view(widget.id).whenComplete((){
      if(_News_newspaper_publisherController.status == true){
        setState(() {
          data = _News_newspaper_publisherController.data;
            if(ViewImage){
                if(ViewedImageType=="slider"){
                  var images=data["data"]["images"];
                  images.forEach((image) async {
                    imgList.add("http://192.168.0.101/framework/"+image["logo_image"]);
                  });
                }
                else{
                    if(data["data"]["logo_image"] != null){
                      imgList.add("http://192.168.0.101/framework/" + data["data"]["logo_image"]);
                    }
                }
            }
        });
        Future.delayed(Duration.zero, () => hideLoaderDialogFunction(context));
      }else{
        ShowToast('warning',_News_newspaper_publisherController.message);
        Future.delayed(Duration.zero, () => hideLoaderDialogFunction(context));
      }
    });
  }
  
  deleteItem() async {
      showLoaderDialogFunction(context);
        _News_newspaper_publisherController.delete(widget.id).whenComplete((){
          if(_News_newspaper_publisherController.status == true){
            setState(() {
                ShowToast('success',_News_newspaper_publisherController.message);
                hideLoaderDialogFunction(context);
                Navigator.push(
                    context,
                    MaterialPageRoute(builder: (context) =>News_newspaper_publishersIndex())
                );
            });
          }else{
            ShowToast('warning',_News_newspaper_publisherController.message);
            hideLoaderDialogFunction(context);
          }
        });
    }

    delete () async {
      showDialog(
          context: context,
          barrierDismissible: false,
          builder: (BuildContext context) {
            return AlertDialog(
              title: Center(child: Text('Alert')),
              content: Column(
                mainAxisSize: MainAxisSize.min,
                children: <Widget>[
                  Container(
                    padding: EdgeInsets.only(bottom: 30.0),
                    child: Text(
                     language =="en" ? messages_en.getTranslation("confirmDeleteMessage") : messages_ar.getTranslation("confirmDeleteMessage"),
                      textAlign: TextAlign.center,
                      style: TextStyle(
                        color: Colors.red,
                      ),
                    ),
                  ),
                  Row(
                      mainAxisAlignment: MainAxisAlignment.spaceBetween,
                      children: <Widget>[
                        FlatButton(
                            child: Text(language =="en" ? messages_en.getTranslation("yes") : messages_ar.getTranslation("yes")),
                            onPressed: () {
                              deleteItem();
                            }),
                        FlatButton(
                            child: Text(language =="en" ? messages_en.getTranslation("no") : messages_ar.getTranslation("no")),
                            autofocus: true,
                            color: Theme.of(context).primaryColor,
                            textColor: Colors.white,
                            onPressed: () {
                              Navigator.of(context).pop();
                            })
                      ])
                ],
              ),
            );
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
        language =="en" ? messages_en.getTranslation("News_newspaper_publishers") : messages_ar.getTranslation
                                      ("News_newspaper_publishers"),
          style: Theme.of(context).textTheme.title,
        ),
        centerTitle: true,
        leading: IconButton(icon:Icon(Icons.arrow_back),
        onPressed:() => Navigator.of(context).push(
        MaterialPageRoute(builder: (context) => News_newspaper_publishersIndex())
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
                    language =="en" ? messages_en.getTranslation("logo_image") : messages_ar.getTranslation("logo_image"),
                    style: Theme.of(context).textTheme.body1,
                    textAlign: TextAlign.center,
                  ),

                  Padding(
                  padding: EdgeInsets.only(top:20.0,right: 0.0),
                  child:Directionality(
                    textDirection: language =="ar" ? TextDirection.rtl : TextDirection.ltr,
                    child: Text(
                      language =="en" ? messages_en.getTranslation("newspaper_name_ar") : messages_ar.getTranslation("newspaper_name_ar"),
                      style: TextStyle(fontWeight: FontWeight.bold),
                      textDirection: language =="ar" ? TextDirection.rtl : TextDirection.ltr,
                    ),
                  )
                  ),
                  Text(
                      data["data"]["newspaper_name_ar"].toString()+language =="en" ? messages_en.getTranslation("SARcurrency") : messages_ar.getTranslation("SARcurrency")
                  ),

                  Table(
                      children:[
                        TableRow(
                            children: [
                              Text(
                                language =="en" ? messages_en.getTranslation("description_ar") : messages_ar.getTranslation
                                                                                    ("description_ar"),
                                style: TextStyle(fontWeight: FontWeight.bold),
                              ),
                              Text(
                                  data["data"]["description_ar"].toString()
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
                                language =="en" ? messages_en.getTranslation("website_link") : messages_ar.getTranslation("website_link"),
                                style: TextStyle(fontWeight: FontWeight.bold),
                              ),
                              Text(
                                  data["data"]["website_link"].toString()
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


        import '../../Controllers/ProductController.dart';
import '../../helpers/LoaderDialog.dart';
import '../../helpers/ToastHelper.dart';
import 'package:framework_01_5/helpers/LanguageHelper.dart' as LanguageHelper;
import '../../lang/ar/products.dart' as messages_ar;
import '../../lang/en/products.dart' as messages_en;
import '../../main.dart';
import '../../helpers/SizeConfig.dart';
import 'package:flutter/widgets.dart';
import 'package:flutter/material.dart';
import '../Home.dart';
import 'package:carousel_slider/carousel_slider.dart';

import '../../Views/products/index.dart';
import '../../Views/products/update.dart';


class ProductsView extends StatefulWidget {

  final int id;
  ProductsView(this.id, {Key key}) : super(key: key);

  @override
  State<StatefulWidget> createState() {
    // TODO: implement createState
    return _ProductsViewState();
  }
}

class _ProductsViewState extends State<ProductsView>{
  //declare variables here
var language = LanguageHelper.Language;
    final List<String> imgList = [];
    bool ViewImage = true;
    String ViewedImageType = "slider";
  var data;

  ProductController _ProductController = new ProductController();
  read() async {
    //get  data
    Future.delayed(Duration.zero, () => showLoaderDialogFunction(context));
    _ProductController.view(widget.id).whenComplete((){
      if(_ProductController.status == true){
        setState(() {
          data = _ProductController.data;
            if(ViewImage){
                if(ViewedImageType=="slider"){
                  var images=data["data"]["images"];
                  images.forEach((image) async {
                    imgList.add("http://192.168.1.101/framework/"+image["image"]);
                  });
                }
                else{
                    if(data["data"]["product_image"] != null){
                      imgList.add("http://192.168.1.101/framework/" + data["data"]["product_image"]);
                    }
                }
            }
        });
        Future.delayed(Duration.zero, () => hideLoaderDialogFunction(context));
      }else{
        ShowToast('warning',_ProductController.message);
        Future.delayed(Duration.zero, () => hideLoaderDialogFunction(context));
      }
    });
  }

  deleteItem() async {
      showLoaderDialogFunction(context);
        _ProductController.delete(widget.id).whenComplete((){
          if(_ProductController.status == true){
            setState(() {
                ShowToast('success',_ProductController.message);
                hideLoaderDialogFunction(context);
                Navigator.push(
                    context,
                    MaterialPageRoute(builder: (context) =>ProductsIndex())
                );
            });
          }else{
            ShowToast('warning',_ProductController.message);
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


   ﻿return Scaffold(
      appBar: AppBar(
        title:Text(
        language =="en" ? messages_en.getTranslation("Products") : messages_ar.getTranslation
                                      ("Products"),
          style: Theme.of(context).textTheme.title,
        ),
        centerTitle: true,
        leading: IconButton(icon:Icon(Icons.arrow_back),
        onPressed:() => Navigator.of(context).push(
        MaterialPageRoute(builder: (context) => ProductsIndex())
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
                    "اسم المنتج",
                    style: Theme.of(context).textTheme.body1,
                    textAlign: TextAlign.center,
                  ),

                  Padding(
                  padding: EdgeInsets.only(top:20.0,right: 0.0),
                  child:Directionality(
                    textDirection: Language  =="ar" ? TextDirection.rtl : TextDirection.ltr,
                    child: Text(
                      "وصف المنتج",
                      style: TextStyle(fontWeight: FontWeight.bold),
                      textDirection: Language  =="ar" ? TextDirection.rtl : TextDirection.ltr,
                    ),
                  )
                  ),
                  Text(
                    "وصف المنتج هنا ، وصف المنتج هنا ، وصف المنتج هناوصف المنتج هنا ، وصف المنتج هنا ، وصف المنتج هناوصف المنتج هنا ، وصف المنتج هنا ، وصف المنتج هنا"
                  ),

                  Table(
                      children:[
                        TableRow(
                            children: [
                              Text(
                                "اسم العنصر",
                                style: TextStyle(fontWeight: FontWeight.bold),
                              ),
                              Text(
                                  "قيمة العنصر"
                              ),
                            ]
                        ),
                        TableRow(
                            children: [
                              Text(
                                "اسم العنصر",
                                style: TextStyle(fontWeight: FontWeight.bold),
                              ),
                              Text(
                                  "قيمة العنصر"
                              ),
                            ]
                        ),
                        TableRow(
                            children: [
                              Text(
                                "اسم العنصر",
                                style: TextStyle(fontWeight: FontWeight.bold),
                              ),
                              Text(
                                  "قيمة العنصر"
                              ),
                            ]
                        ),
                      ]
                  ),
                  '.$orderBtnCode.'
                ],
              ): null ,
            )
    );
  }
}

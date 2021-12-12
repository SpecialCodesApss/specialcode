
        import '../../Controllers/B_testController.dart';
import '../../helpers/LoaderDialog.dart';
import '../../helpers/ToastHelper.dart';
import 'package:framework_01_5/helpers/LanguageHelper.dart' as LanguageHelper;
import '../../lang/ar/b_tests.dart' as messages_ar;
import '../../lang/en/b_tests.dart' as messages_en;
import '../../main.dart';
import '../../helpers/SizeConfig.dart';
import 'package:flutter/widgets.dart';
import 'package:flutter/material.dart';
import '../Home.dart';
import 'package:carousel_slider/carousel_slider.dart';

import '../../Views/b_tests/index.dart';
import '../../Views/b_tests/update.dart';


class B_testsView extends StatefulWidget {

  final int id;
  B_testsView(this.id, {Key key}) : super(key: key);

  @override
  State<StatefulWidget> createState() {
    // TODO: implement createState
    return _B_testsViewState();
  }
}

class _B_testsViewState extends State<B_testsView>{
  //declare variables here
var language = LanguageHelper.Language;
    final List<String> imgList = [];
    bool ViewImage = true;
    String ViewedImageType = "slider";
  var data;

  B_testController _B_testController = new B_testController();
  read() async {
    //get  data
    Future.delayed(Duration.zero, () => showLoaderDialogFunction(context));
    _B_testController.view(widget.id).whenComplete((){
      if(_B_testController.status == true){
        setState(() {
          data = _B_testController.data;
            if(ViewImage){
                if(ViewedImageType=="slider"){
                  var images=data["data"]["images"];
                  images.forEach((image) async {
                    imgList.add("http://192.168.1.101/framework/"+image["image"]);
                  });
                }
                else{
                    if(data["data"]["b_test_image"] != null){
                      imgList.add("http://192.168.1.101/framework/" + data["data"]["b_test_image"]);
                    }
                }
            }
        });
        Future.delayed(Duration.zero, () => hideLoaderDialogFunction(context));
      }else{
        ShowToast('warning',_B_testController.message);
        Future.delayed(Duration.zero, () => hideLoaderDialogFunction(context));
      }
    });
  }
  
  deleteItem() async {
      showLoaderDialogFunction(context);
        _B_testController.delete(widget.id).whenComplete((){
          if(_B_testController.status == true){
            setState(() {
                ShowToast('success',_B_testController.message);
                hideLoaderDialogFunction(context);
                Navigator.push(
                    context,
                    MaterialPageRoute(builder: (context) =>B_testsIndex())
                );
            });
          }else{
            ShowToast('warning',_B_testController.message);
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
        language =="en" ? messages_en.getTranslation("B_tests") : messages_ar.getTranslation
                                      ("B_tests"),
          style: Theme.of(context).textTheme.title,
        ),
        centerTitle: true,
        leading: IconButton(icon:Icon(Icons.arrow_back),
        onPressed:() => Navigator.of(context).push(
        MaterialPageRoute(builder: (context) => B_testsIndex())
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
                    language =="en" ? messages_en.getTranslation("theImage") : messages_ar.getTranslation("theImage"),
                    style: Theme.of(context).textTheme.body1,
                    textAlign: TextAlign.center,
                  ),

                  Padding(
                  padding: EdgeInsets.only(top:20.0,right: 0.0),
                  child:Directionality(
                    textDirection: language =="ar" ? TextDirection.rtl : TextDirection.ltr,
                    child: Text(
                      language =="en" ? messages_en.getTranslation("id") : messages_ar.getTranslation("id"),
                      style: TextStyle(fontWeight: FontWeight.bold),
                      textDirection: language =="ar" ? TextDirection.rtl : TextDirection.ltr,
                    ),
                  )
                  ),
                  Text(
                      data["data"]["id"].toString()+language =="en" ? messages_en.getTranslation("SARcurrency") : messages_ar.getTranslation("SARcurrency")
                  ),

                  Table(
                      children:[
                        TableRow(
                            children: [
                              Text(
                                language =="en" ? messages_en.getTranslation("id") : messages_ar.getTranslation
                                                                                    ("id"),
                                style: TextStyle(fontWeight: FontWeight.bold),
                              ),
                              Text(
                                  data["data"]["id"].toString()
                              ),
                            ]
                        ),
                        TableRow(
                            children: [
                              Text(
                                language =="en" ? messages_en.getTranslation("id") : messages_ar.getTranslation("id"),
                                style: TextStyle(fontWeight: FontWeight.bold),
                              ),
                              Text(
                                  data["data"]["id"].toString()
                              ),
                            ]
                        ),
                        TableRow(
                            children: [
                              Text(
                                language =="en" ? messages_en.getTranslation("id") : messages_ar.getTranslation("id"),
                                style: TextStyle(fontWeight: FontWeight.bold),
                              ),
                              Text(
                                  data["data"]["id"].toString()
                              ),
                            ]
                        ),

                      ]
                  ),

            
            Padding(
                      padding: EdgeInsets.only(top:50.0,left: 30.0,right: 30.0),
                      child: RaisedButton(
                          color: Theme.of(context).primaryColor ,
                          child:  Text(
                            language =="en" ? messages_en.getTranslation("order") : messages_ar.getTranslation("order"),
                            style: Theme.of(context).textTheme.button,
                          ),
                          onPressed: null
                      ),
                  ),
        

            Padding(
                    padding: EdgeInsets.only(top:50.0,left: 30.0,right: 30.0),
                    child: Row(
                      children: <Widget>[
                        Padding(
                          padding: EdgeInsets.only(left: 30.0,right: 30.0),
                        child: RaisedButton(
                          color: Theme.of(context).primaryColor ,
                          child:  Text(
                           language =="en" ? messages_en.getTranslation("edit") : messages_ar.getTranslation("edit"),
                            style: Theme.of(context).textTheme.button,
                          ),
                          onPressed:() => Navigator.of(context).push(
                              MaterialPageRoute(builder: (context) => B_testsUpdate(widget.id))
                          ),
                          padding: EdgeInsets.only(left: 30.0,right: 30.0),
                        ),
                        ),
                        Padding(
                      padding: EdgeInsets.only(left: 30.0,right: 30.0),
                      child:RaisedButton(
                            color: Colors.red ,
                            child:  Text(
                              language =="en" ? messages_en.getTranslation("delete") : messages_ar.getTranslation("delete"),
                              style: Theme.of(context).textTheme.button,
                            ),
                          onPressed:() => delete(),
                          padding: EdgeInsets.only(left: 30.0,right: 30.0),
                        ),
                      ),
                      ],
                    )
                  )

                ],
              ): null ,
            )
    );
  }
}

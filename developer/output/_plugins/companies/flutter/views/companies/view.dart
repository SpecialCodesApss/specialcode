
        import '../../Controllers/CompanieController.dart';
import '../../helpers/LoaderDialog.dart';
import '../../helpers/ToastHelper.dart';
import 'package:framework_01_6/helpers/LanguageHelper.dart' as LanguageHelper;
import '../../lang/ar/companies.dart' as messages_ar;
import '../../lang/en/companies.dart' as messages_en;
import '../../main.dart';
import '../../helpers/SizeConfig.dart';
import 'package:flutter/widgets.dart';
import 'package:flutter/material.dart';
import '../Home.dart';
import 'package:carousel_slider/carousel_slider.dart';

import '../../Views/companies/index.dart';



class CompaniesView extends StatefulWidget {

  final int id;
  CompaniesView(this.id, {Key key}) : super(key: key);

  @override
  State<StatefulWidget> createState() {
    // TODO: implement createState
    return _CompaniesViewState();
  }
}

class _CompaniesViewState extends State<CompaniesView>{
  //declare variables here
var language = LanguageHelper.Language;
    final List<String> imgList = [];
    bool ViewImage = true;
    String ViewedImageType = "slider";
  var data;

  CompanieController _CompanieController = new CompanieController();
  read() async {
    //get  data
    Future.delayed(Duration.zero, () => showLoaderDialogFunction(context));
    _CompanieController.view(widget.id).whenComplete((){
      if(_CompanieController.status == true){
        setState(() {
          data = _CompanieController.data;
            // if(ViewImage){
            //     if(ViewedImageType=="slider"){
            //       var images=data["data"]["images"];
            //       images.forEach((image) async {
            //         imgList.add("http://192.168.1.101/framework/"+image["image"]);
            //       });
            //     }
            //     else{
            //         if(data["data"]["companie_image"] != null){
            //           imgList.add("http://192.168.1.101/framework/" + data["data"]["companie_image"]);
            //         }
            //     }
            // }
        });
        Future.delayed(Duration.zero, () => hideLoaderDialogFunction(context));
      }else{
        ShowToast('warning',_CompanieController.message);
        Future.delayed(Duration.zero, () => hideLoaderDialogFunction(context));
      }
    });
  }
  
  deleteItem() async {
      showLoaderDialogFunction(context);
        _CompanieController.delete(widget.id).whenComplete((){
          if(_CompanieController.status == true){
            setState(() {
                ShowToast('success',_CompanieController.message);
                hideLoaderDialogFunction(context);
                Navigator.push(
                    context,
                    MaterialPageRoute(builder: (context) =>CompaniesIndex())
                );
            });
          }else{
            ShowToast('warning',_CompanieController.message);
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
        language =="en" ? messages_en.getTranslation("Companies") : messages_ar.getTranslation
                                      ("Companies"),
          style: Theme.of(context).textTheme.title,
        ),
        centerTitle: true,
        leading: IconButton(icon:Icon(Icons.arrow_back),
        onPressed:() => Navigator.of(context).push(
        MaterialPageRoute(builder: (context) => CompaniesIndex())
        ),
        ),
      ),

        body: Container(
            child: data != null ? ListView(
              padding: EdgeInsets.all(10.0),
                children: <Widget>[

                  Image.network(
                      "http://192.168.1.101/framework/" + data["data"]["logo_image"],
                      fit: BoxFit.cover, width: 1000),
                  // ViewImage==true ? CarouselSlider(
                  //   options:  CarouselOptions(
                  //     viewportFraction: 1.0,
                  //     enlargeCenterPage: false,
                  //     autoPlay: ViewedImageType=="slider" ? false : false,
                  //     autoPlayInterval: Duration(seconds: 3),
                  //   ),
                  //   items: imgList.map((item) => Container(
                  //     child: Center(
                  //         child: Image.network(item, fit: BoxFit.cover, width: 1000)
                  //     ),
                  //   )).toList(),
                  // ) : SizedBox(),
                  Text(
                    language =="en" ?
                    data["data"]["company_name_en"] :
                    data["data"]["company_name_ar"],
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
                      data["data"]["id"].toString()
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

            


                ],
              ): null ,
            )
    );
  }
}

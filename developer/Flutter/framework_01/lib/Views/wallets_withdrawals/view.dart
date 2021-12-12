
        import 'package:framework_01_6/Controllers/Wallets_withdrawalController.dart';
import 'package:framework_01_6/helpers/LoaderDialog.dart';
import 'package:framework_01_6/helpers/ToastHelper.dart';
        import 'package:framework_01_6/helpers/LanguageHelper.dart' as LanguageHelper;
        import '../../lang/ar/wallets.dart' as messages_ar;
        import '../../lang/en/wallets.dart' as messages_en;
import 'package:framework_01_6/main.dart';
import 'package:framework_01_6/helpers/SizeConfig.dart';
import 'package:flutter/widgets.dart';
import 'package:flutter/material.dart';
import '../Home.dart';
//import 'package:carousel_slider/carousel_slider.dart';

import 'package:framework_01_6/Views/wallets_withdrawals/index.dart';
import 'package:framework_01_6/Views/wallets_withdrawals/update.dart';


class Wallets_withdrawalsView extends StatefulWidget {

  final int id;
  var language = LanguageHelper.Language;
  Wallets_withdrawalsView(this.id, {Key key}) : super(key: key);

  @override
  State<StatefulWidget> createState() {
    // TODO: implement createState
    return _Wallets_withdrawalsViewState();
  }
}

class _Wallets_withdrawalsViewState extends State<Wallets_withdrawalsView>{
  //declare variables here
    final List<String> imgList = [];
    bool ViewImage = false;
    String ViewedImageType = "static";
  var data;
    var language = LanguageHelper.Language;

  Wallets_withdrawalController _Wallets_withdrawalController = new Wallets_withdrawalController();
  read() async {
    //get  data
    Future.delayed(Duration.zero, () => showLoaderDialogFunction(context));
    _Wallets_withdrawalController.view(widget.id).whenComplete((){
      if(_Wallets_withdrawalController.status == true){
        setState(() {
          data = _Wallets_withdrawalController.data;
            if(ViewImage){
                if(ViewedImageType=="slider"){
                  var images=data["data"]["images"];
                  images.forEach((image) async {
                    imgList.add("http://192.168.0.101/framework/"+image["image"]);
                  });
                }
                else{
                    if(data["data"]["wallets_withdrawal_image"] != null){
                      imgList.add("http://192.168.0.101/framework/" + data["data"]["wallets_withdrawal_image"]);
                    }
                }
            }
        });
        Future.delayed(Duration.zero, () => hideLoaderDialogFunction(context));
      }else{
        ShowToast('warning',_Wallets_withdrawalController.message);
        Future.delayed(Duration.zero, () => hideLoaderDialogFunction(context));
      }
    });
  }
  
  deleteItem() async {
      showLoaderDialogFunction(context);
        _Wallets_withdrawalController.delete(widget.id).whenComplete((){
          if(_Wallets_withdrawalController.status == true){
            setState(() {
                ShowToast('success',_Wallets_withdrawalController.message);
                hideLoaderDialogFunction(context);
                Navigator.push(
                    context,
                    MaterialPageRoute(builder: (context) =>Wallets_withdrawalsIndex())
                );
            });
          }else{
            ShowToast('warning',_Wallets_withdrawalController.message);
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
                      language =="en" ? messages_en.getTranslation("confirmDeleteMessage") : messages_ar.getTranslation
                        ("confirmDeleteMessage"),
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
                            child: Text(language =="en" ? messages_en.getTranslation("yes") : messages_ar.getTranslation
                              ("yes")),
                            onPressed: () {
                              deleteItem();
                            }),
                        FlatButton(
                            child: Text(language =="en" ? messages_en.getTranslation("no") : messages_ar.getTranslation
                              ("no")),
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
  initState(){
    super.initState();
    read();
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
          language =="en" ? messages_en.getTranslation("Wallets_withdrawals") : messages_ar.getTranslation
            ("Wallets_withdrawals"),
          style: Theme.of(context).textTheme.title,
        ),
        centerTitle: true,
        leading: IconButton(icon:Icon(Icons.arrow_back),
        onPressed:() => Navigator.of(context).push(
        MaterialPageRoute(builder: (context) => Wallets_withdrawalsIndex())
        ),
        ),
      ),

       body: Container(
         child: data != null ? ListView(
           padding: EdgeInsets.all(5.0),
           children: <Widget>[
             Center(
               child: Text(
                 data["data"]["withdrawal_amount_required"].toString()+language =="en" ? messages_en.getTranslation("SARcurrency") : messages_ar.getTranslation
                   ("SARcurrency"),
                 style: TextStyle(
                   fontWeight: FontWeight.bold,
                   fontSize: 40.0,
                   color: Colors.green,
                 ),
               ),
             ),
             Table(
                 children:[
                   TableRow(
                       children: [
                         Text(
                           language =="en" ? messages_en.getTranslation("money_withdrawal_status") : messages_ar.getTranslation
                             ("money_withdrawal_status"),
                           style: TextStyle(fontWeight: FontWeight.bold),
                         ),
                         Text(
                           data["data"]["money_withdrawal_status"].toString(),
                           style: TextStyle(
                             fontSize: 16.0,
                             fontWeight: FontWeight.bold,
                             color: Colors.red,
                           ),
                         ),
                       ]
                   ),
                   TableRow(
                       children: [
                         Text(
                           language =="en" ? messages_en.getTranslation("bank_name") : messages_ar.getTranslation
                             ("bank_name"),
                           style: TextStyle(fontWeight: FontWeight.bold),
                         ),
                         Text(
                           data["data"]["bank_name"].toString(),
                           style: TextStyle(
                             fontSize: 16.0,
                             fontWeight: FontWeight.bold,
                             color: Colors.blueAccent,
                           ),
                         ),
                       ]
                   ),
                   TableRow(
                       children: [
                         Text(
                           language =="en" ? messages_en.getTranslation("account_owner_name") : messages_ar.getTranslation
                             ("account_owner_name"),
                           style: TextStyle(fontWeight: FontWeight.bold),
                         ),
                         Text(
                           data["data"]['account_owner_name'] ,
                           style: TextStyle(
                             fontSize: 16.0,
                             fontWeight: FontWeight.bold,
                             color: Colors.green,
                           ),
                         ),
                       ]
                   ),
                   TableRow(
                       children: [
                         Text(
                           language =="en" ? messages_en.getTranslation("account_number") : messages_ar.getTranslation
                             ("account_number"),
                           style: TextStyle(fontWeight: FontWeight.bold),
                         ),
                         Text(
                             data["data"]["account_number"].toString(),
                           style: TextStyle(
                             fontSize: 16.0,
                             fontWeight: FontWeight.bold,
                           ),
                         ),
                       ]
                   ),
                   TableRow(
                       children: [
                         Text(
                           language =="en" ? messages_en.getTranslation("iban_number") : messages_ar.getTranslation
                             ("iban_number"),
                           style: TextStyle(fontWeight: FontWeight.bold),
                         ),
                         Text(
                           data["data"]["iban_number"].toString(),
                           style: TextStyle(
                             fontSize: 16.0,
                             fontWeight: FontWeight.bold,
                           ),
                         ),
                       ]
                   ),
                   TableRow(
                       children: [
                         Text(
                           language =="en" ? messages_en.getTranslation("created_at") : messages_ar.getTranslation
                             ("created_at"),
                           style: TextStyle(fontWeight: FontWeight.bold),
                         ),
                         Text(
                             data["data"]["created_at"].toString(),
                           style: TextStyle(
                             fontSize: 16.0,
                             fontWeight: FontWeight.bold,
                           ),
                         ),
                       ]
                   ),

                 ]
             ),


             data["data"]["money_withdrawal_status"] == "قيد المراجعة" ? Padding(
                    padding: EdgeInsets.only(top:50.0,left: 30.0,right: 30.0),
                    child: Row(
                      children: <Widget>[
                        Padding(
                          padding: EdgeInsets.only(left: 30.0,right: 30.0),
                        child: RaisedButton(
                          color: Theme.of(context).primaryColor ,
                          child:  Text(
                            language =="en" ? messages_en.getTranslation("edit") : messages_ar.getTranslation
                              ("edit"),
                            style: Theme.of(context).textTheme.button,
                          ),
                          onPressed:() => Navigator.of(context).push(
                              MaterialPageRoute(builder: (context) => Wallets_withdrawalsUpdate(widget.id))
                          ),
                          padding: EdgeInsets.only(left: 30.0,right: 30.0),
                        ),
                        ),
                        Padding(
                      padding: EdgeInsets.only(left: 30.0,right: 30.0),
                      child:RaisedButton(
                            color: Colors.red ,
                            child:  Text(
                              language =="en" ? messages_en.getTranslation("delete") : messages_ar.getTranslation
                                ("delete"),
                              style: Theme.of(context).textTheme.button,
                            ),
                          onPressed:() => delete(),
                          padding: EdgeInsets.only(left: 30.0,right: 30.0),
                        ),
                      ),
                      ],
                    )
                  ):SizedBox()
                ],
              ): null ,
            )
    );
  }
}

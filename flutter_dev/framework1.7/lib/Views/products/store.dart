
import '../../Controllers/ProductController.dart';
import '../../helpers/LoaderDialog.dart';
import '../../helpers/ToastHelper.dart';
import '../../helpers/LanguageHelper.dart' as LanguageHelper;
import '../../main.dart';
import '../../helpers/SizeConfig.dart';
import 'package:flutter/widgets.dart';
import 'package:flutter/material.dart';
import '../Home.dart';
import 'dart:async';
import 'dart:io';
import 'package:flutter/cupertino.dart';
import 'package:flutter/src/widgets/basic.dart';
import 'package:image_picker/image_picker.dart';
import 'package:select_form_field/select_form_field.dart';
import '../../Views/products/index.dart';

class ProductsStore extends StatefulWidget {
  @override
  State<StatefulWidget> createState() {
    // TODO: implement createState
    return _ProductsStoreState();
  }
}

class _ProductsStoreState extends State<ProductsStore>{
  //declare variables here

var language = LanguageHelper.Language;
  var data;

  


  ProductController _ProductController = new ProductController();

  final TextEditingController _nameController = new TextEditingController();
                        var _selector = "";

                        
                    final List<Map<String, dynamic>> _selector_items = [
                    
                            {
                              'value': 'active',
                              'label': LanguageHelper.trans("products", "active"),
                            },
                            {
                              'value': 'in active',
                              'label': LanguageHelper.trans("products", "in active"),
                            },
                        ];
                    

  _onPressedStore(){
    setState(() {
      showLoaderDialogFunction(context);
      if(_nameController.text.trim().isNotEmpty&&_selector != null){
        _ProductController.store(_nameController.text.trim(),_selector).whenComplete((){
          if(_ProductController.status == true){
            hideLoaderDialogFunction(context);
            ShowToast('success',_ProductController.message);
            Navigator.push(
                context,
                MaterialPageRoute(builder: (context) =>ProductsIndex())
            );
          }else{
            hideLoaderDialogFunction(context);
            ShowToast('warning',_ProductController.message);
          }
        });
      }
      else{
        hideLoaderDialogFunction(context);
        ShowToast('error',
        LanguageHelper.trans("app","pleasefillallfields"));
      }
    });
  }

  read() async {
    await LanguageHelper.initialize();
    language = LanguageHelper.Language;
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
        LanguageHelper.trans("products","Products"),
          style: Theme.of(context).textTheme.subtitle1,
        ),
        centerTitle: true,
        leading: IconButton(icon:Icon(Icons.arrow_back),
        onPressed:() => Navigator.of(context).push(
        MaterialPageRoute(builder: (context) => ProductsIndex())
        ),
        ),
      ),

      body: Container(
        child: ListView(
        padding: EdgeInsets.all(10.0),
                          children: <Widget>[
                            TextField(
                                                      controller: _nameController,
                                                      style: Theme.of(context).textTheme.bodyText1,
                                                      keyboardType: TextInputType.text,
                                                      decoration: InputDecoration(
                                                        icon: Icon(Icons.arrow_left),
                                                        hintText:
                                                        LanguageHelper.trans("products","name"),
                                                        labelText:LanguageHelper.trans("products","name"),
                                                      ),
                                                    ),
                                            
                        Directionality(
        textDirection: language =="en" ? TextDirection.ltr : TextDirection.rtl ,
        child: SelectFormField(
          type: SelectFormFieldType.dropdown, // or can be dialog
          initialValue: "",
          labelText: LanguageHelper.trans("products","selector"),
          items: _selector_items,
          onChanged: (val) {
            setState(() {
              _selector = val;
            });
          },
          onSaved: (val) => print(val),
          textDirection: language =="en" ? TextDirection.ltr : TextDirection.rtl ,
          textAlign: language =="en" ? TextAlign.start : TextAlign.start ,
        ),
      ),
                                            
                            

                        SizedBox(
                          height: 20,
                        ),
                        RaisedButton(
                          color: Theme.of(context).primaryColor ,
                          child:  Text(
                          LanguageHelper.trans("app","create"),
                            style: Theme.of(context).textTheme.button,
                          ),
                          onPressed: _onPressedStore,
                        ),
                      ]
                      ),
              )
    );
  }
}

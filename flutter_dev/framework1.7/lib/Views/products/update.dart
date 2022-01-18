
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


class ProductsUpdate extends StatefulWidget {

  final int id;
  ProductsUpdate(this.id);
  @override
  State<StatefulWidget> createState() {
    // TODO: implement createState
    return _ProductsUpdateState();
  }
}

class _ProductsUpdateState extends State<ProductsUpdate>{
  //declare variables here
  var language = LanguageHelper.Language;
  var data;


  


  ProductController _ProductController = new ProductController();

  final TextEditingController _nameController = new TextEditingController();final TextEditingController _selectorController = new TextEditingController();

  _onPressedUpdate(){
    setState(() {
      showLoaderDialogFunction(context);
      if(_nameController.text.trim().isNotEmpty&&_selectorController.text.trim().isNotEmpty){
        _ProductController.update(widget.id,_nameController.text.trim(),_selectorController.text.trim()).whenComplete((){
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
        LanguageHelper.trans("app","pleasefillallfields")
        );
      }
    });
  }

  read() async {

  await LanguageHelper.initialize();
    language = LanguageHelper.Language;

    Future.delayed(Duration.zero, () => showLoaderDialogFunction(context));
    _ProductController.view(widget.id).whenComplete((){
      if(_ProductController.status == true){
        setState(() {
          data=_ProductController.data;_nameController.text=_ProductController.data["data"]["name"].toString() ;_selectorController.text=_ProductController.data["data"]["selector"].toString() ;
        });
        Future.delayed(Duration.zero, () => hideLoaderDialogFunction(context));
      }else{
        ShowToast('warning',_ProductController.message);
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
                                                        hintText:LanguageHelper.trans("products","name"),
                                                        labelText:LanguageHelper.trans("products","name"),
                                                      ),
                                                    ),
                                            TextField(
                                                      controller: _selectorController,
                                                      style: Theme.of(context).textTheme.bodyText1,
                                                      keyboardType: TextInputType.text,
                                                      decoration: InputDecoration(
                                                        icon: Icon(Icons.arrow_left),
                                                        hintText:LanguageHelper.trans("products","selector"),
                                                        labelText:LanguageHelper.trans("products","selector"),
                                                      ),
                                                    ),
                                            
                                  

                              SizedBox(
                                height: 20,
                              ),
                              RaisedButton(
                                color: Theme.of(context).primaryColor ,
                                child:  Text(
                                LanguageHelper.trans("app","update"),
                                  style: Theme.of(context).textTheme.button,
                                ),
                                onPressed: _onPressedUpdate,
                              ),
                            ]
                            ),
                    )
    );
  }
}

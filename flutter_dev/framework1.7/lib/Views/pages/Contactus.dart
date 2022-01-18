import 'package:flutter_dev/Controllers/Admin_messageController.dart';
import 'package:flutter_dev/helpers/InternetHelper.dart';
import 'package:hexcolor/hexcolor.dart';
import '../../../Controllers/CustomerServiceMsgController.dart';
import '../../Controllers/PagesController.dart';
import '../../helpers/LoaderDialog.dart';
import '../../helpers/ToastHelper.dart';
import '../../helpers/LanguageHelper.dart' as LanguageHelper;
import '../../helpers/SizeConfig.dart';
import 'package:flutter/widgets.dart';
import 'package:flutter/material.dart';
import 'package:image_picker/image_picker.dart';
import 'dart:io';
import '../Home.dart';
import 'package:select_form_field/select_form_field.dart';

class Contactus extends StatefulWidget {
  @override
  State<StatefulWidget> createState() {
    // TODO: implement createState
    return _ContactusState();
  }
}

class _ContactusState extends State<Contactus> {
  //declare variables here
  var pageTitle = '';
  var pageHtml = '';

  var language = LanguageHelper.Language;

  var _message_type = "Complaint";
  final List<Map<String, dynamic>> _items = [
    {
      'value': 'Complaint',
      'label': LanguageHelper.trans("admin_messages", "Complaint"),
    },
    {
      'value': 'Suggestion',
      'label': LanguageHelper.trans("admin_messages", "Suggestion"),
    },
    {
      'value': 'Technical Support',
      'label': LanguageHelper.trans("admin_messages", "Technical Support"),
    },
    {
      'value': 'Management',
      'label': LanguageHelper.trans("admin_messages", "Management"),
    },
  ];

  var image;
  Future getImage() async {
    FocusScopeNode currentFocus = FocusScope.of(context);
    if (!currentFocus.hasPrimaryFocus) {
      currentFocus.unfocus();
    }
    var picked_image = await ImagePicker.platform.pickImage(source: ImageSource.gallery);
    setState(() {
      image = File(picked_image!.path);
    });
  }



  Admin_messageController _Admin_messageController = new Admin_messageController();
  final TextEditingController _fullnameController = new TextEditingController();final TextEditingController _emailController = new TextEditingController();final TextEditingController _mobileController = new TextEditingController();final TextEditingController _message_typeController = new TextEditingController();final TextEditingController _messages_textController = new TextEditingController();final TextEditingController _open_statusController = new TextEditingController();final TextEditingController _marked_as_readedController = new TextEditingController();final TextEditingController _marked_as_deletedController = new TextEditingController();


  /*Internet and loading*/
  /**************/
  var is_not_connected = false;
  var is_loading = false;
  checkInternetConnection() async{
    var connected = await InternetHelper().chkInternetConnection(context);
    setState((){ is_not_connected = connected;});
  }
  /*End Internet and loading*/
  /**************/



  @override
  initState() {
    super.initState();
  }
  @override
  void dispose() {
    // TODO: implement dispose
    super.dispose();
  }

  _onPressedStore(){
    setState(() {
      showLoaderDialogFunction(context);
      if(_fullnameController.text.trim().isNotEmpty
          &&_emailController.text.trim().isNotEmpty
          &&_mobileController.text.trim().isNotEmpty
          && _message_type != null
          &&_messages_textController.text.trim().isNotEmpty
      ){
        _Admin_messageController.store(
            _fullnameController.text.trim(),
            _emailController.text.trim(),
            _mobileController.text.trim(),
          _message_type,
            image,
            _messages_textController.text.trim(),
        ).whenComplete((){
          if(_Admin_messageController.status == true){
            hideLoaderDialogFunction(context);
            ShowToast('success',_Admin_messageController.message);
            Navigator.push(
                context,
                MaterialPageRoute(builder: (context) =>Home())
            );
          }else{
            hideLoaderDialogFunction(context);
            ShowToast('warning',_Admin_messageController.message);
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


  @override
  Widget build(BuildContext context) {
    // TODO: implement build
    SizeConfig().init(context); // for media query
    var screenWidthRatio = 10;
    var screenHightRatio = 35;
    var contenttopalignmentratio = 20;
    if (SizeConfig.orientation == Orientation.landscape) {
      screenWidthRatio = 20;
      screenHightRatio = 55;

      contenttopalignmentratio = 10;
    } else {
      screenWidthRatio = 10;
      screenHightRatio = 35;

      contenttopalignmentratio = 3;
    }

    return  Scaffold(
      backgroundColor: HexColor('f0f0f0'),
      appBar: AppBar(
        title: Text(
          //pageTitle,
            LanguageHelper.trans("app","Contactus")
          ,
          style: Theme.of(context).textTheme.subtitle1,
        ),
        centerTitle: true,
      ),
      body:
      /*Internet and loading*/
      /**************/
      is_not_connected == true ?
      InternetHelper().getInternetWidget(context,checkInternetConnection)
          :is_loading == true ?
      Center(child: CircularProgressIndicator())
          :
      /*Internet and loading*/
      /**************/

      Container(
          decoration: BoxDecoration(
            /*image: DecorationImage(
            image: AssetImage("assets/images/bg.png"),
            fit: BoxFit.cover,
          ),*/
          ),
          child: ListView(
            children: <Widget>[



    Container(
    child: Card(
    color: Colors.white.withOpacity(0.8),
    child: Padding(padding: EdgeInsets.all(20.0),
    child:  Column(
                  children: <Widget>[
                    TextField(
                      controller: _fullnameController,
                      textAlign: language == "en" ? TextAlign.left : TextAlign.right ,
                      style: Theme.of(context).textTheme.bodyText1,
                      decoration: InputDecoration(
                        hintText:
                        LanguageHelper.trans("app","name")
                        ,
                      ),
                    ),
                    TextField(
                      controller: _emailController,
                      textAlign: language == "en" ? TextAlign.left : TextAlign.right ,
                      keyboardType: TextInputType.emailAddress,
                      style: Theme.of(context).textTheme.bodyText1,
                      decoration: InputDecoration(
                        hintText:
                        LanguageHelper.trans("app","email")
                        ,
                      ),
                    ),


      Directionality(
        textDirection: language =="en" ? TextDirection.ltr : TextDirection.rtl ,
        child: SelectFormField(
          type: SelectFormFieldType.dropdown, // or can be dialog
          initialValue: 'Complaint',
          labelText: LanguageHelper.trans("admin_messages","message_type"),
          items: _items,
          onChanged: (val) {
            setState(() {
              _message_type = val;
            });
          },
          onSaved: (val) => print(val),
          textDirection: language =="en" ? TextDirection.ltr : TextDirection.rtl ,
          textAlign: language =="en" ? TextAlign.start : TextAlign.start ,
        ),
      ),

                    // TextField(
                    //   controller: _message_typeController,
                    //   textAlign: language == "en" ? TextAlign.left : TextAlign.right ,
                    //   keyboardType: TextInputType.emailAddress,
                    //   style: Theme.of(context).textTheme.bodyText1,
                    //   decoration: InputDecoration(
                    //     hintText:
                    //     LanguageHelper.trans("admin_messages","message_type")
                    //     ,
                    //   ),
                    // ),
                    TextField(
                      controller: _mobileController,
                      textAlign: language == "en" ? TextAlign.left : TextAlign.right ,
                      keyboardType: TextInputType.phone,
                      style: Theme.of(context).textTheme.bodyText1,
                      decoration: InputDecoration(
                        hintText:
                        LanguageHelper.trans("app","mobile")
                        ,
                      ),
                    ),
                    TextField(
                      controller: _messages_textController,
                      textAlign: language == "en" ? TextAlign.left : TextAlign.right ,
                      style: Theme.of(context).textTheme.bodyText1,
                      decoration: InputDecoration(
                        hintText:
                        LanguageHelper.trans("app","Message")
                        ,
                      ),
                      maxLines: 6,
                      keyboardType: TextInputType.multiline,
//                expands: true,
//                minLines: 6,
                    ),


                    image != null ?
                            Image.file(image,width: 150,height: 150,)
                            :Text(
                                LanguageHelper.trans("app","noImageSelected")
                            ),
                                  RaisedButton(
                                    onPressed: getImage,
                                    child: Icon(
                                      Icons.add_a_photo,
                                      color: Colors.white,
                                    ),
                                  ),


                        SizedBox(
                          height: 20,
                        ),

                    ButtonTheme(
                      minWidth: double.infinity,
                      child: RaisedButton(
                          child: Text(
                              LanguageHelper.trans("app","send")
                            ,
                            style: Theme.of(context).textTheme.button,
                          ),
                          onPressed: _onPressedStore),
                      buttonColor: HexColor('232323'),
                    ),
                  ],
                ),
              )
              )
              )

//              Container(
//                child: Card(
//                    color: Colors.white.withOpacity(0.8),
//                    child: Padding(
//                      padding: EdgeInsets.all(20.0),
//                      child: Column(
//                        children: <Widget>[
//                          SingleChildScrollView(
//                            child: HtmlWidget( pageHtml
//                            ),
//                          ),
//
//
//                        ],
//                      ),
//                    )),
//              ),


            ],
          )),
    );
  }
}

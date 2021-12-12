// import 'dart:html';
import 'package:smart_select/smart_select.dart';

import '../../Controllers/News_users_notifications_settingController.dart';
import '../../helpers/LoaderDialog.dart';
import '../../helpers/ToastHelper.dart';
import 'package:framework_01_6/helpers/LanguageHelper.dart' as LanguageHelper;
import '../../lang/ar/news_users_notifications_settings.dart' as messages_ar;
import '../../lang/en/news_users_notifications_settings.dart' as messages_en;
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
import 'package:custom_switch/custom_switch.dart';

import '../../Views/news_users_notifications_settings/index.dart';


class News_users_notifications_settingsUpdate extends StatefulWidget {

  // final int id;
  // News_users_notifications_settingsUpdate(this.id, {Key key}) : super(key: key);
  @override
  State<StatefulWidget> createState() {
    // TODO: implement createState
    return _News_users_notifications_settingsUpdateState();
  }
}

class _News_users_notifications_settingsUpdateState extends State<News_users_notifications_settingsUpdate>{
  //declare variables here
  var language = LanguageHelper.Language;
  var data;

  int notification_activation =0 ;
  bool notification_activation_status = false ;
  bool data_is_loaded = false ;
  String notification_type_value ;

  News_users_notifications_settingController _News_users_notifications_settingController = new News_users_notifications_settingController();

  final TextEditingController _user_idController = new TextEditingController();final TextEditingController _active_notificationController = new TextEditingController();final TextEditingController _notification_typeController = new TextEditingController();

  _onPressedUpdate(){
    setState(() {
      showLoaderDialogFunction(context);
        _News_users_notifications_settingController.update(
            notification_activation.toString(),notification_type_value
      ).whenComplete((){
          if(_News_users_notifications_settingController.status == true){
            hideLoaderDialogFunction(context);
            // ShowToast('success',_News_users_notifications_settingController.message);
            // Navigator.push(
            //     context,
            //     MaterialPageRoute(builder: (context) =>News_users_notifications_settingsIndex())
            // );
          }else{
            hideLoaderDialogFunction(context);
            ShowToast('warning',_News_users_notifications_settingController.message);
          }
        });

    });
  }


  List<S2Choice<String>> notification_typesList = [];

  read() async {

    if(language=="en"){
      notification_typesList =
      [
        S2Choice<String>(value: "every day", title: messages_en.getTranslation("every day")),
        S2Choice<String>(value: "every week", title:  messages_en.getTranslation("every week")) ,
        S2Choice<String>(value: "every month", title: messages_en.getTranslation("every month")),
      ];
    }
    else{
      notification_typesList =
      [
        S2Choice<String>(value: "every day", title: messages_ar.getTranslation("every day")),
        S2Choice<String>(value: "every week", title:  messages_ar.getTranslation("every week")) ,
        S2Choice<String>(value: "every month", title: messages_ar.getTranslation("every month")),
      ];
    }

    Future.delayed(Duration.zero, () => showLoaderDialogFunction(context));
       _News_users_notifications_settingController.view().whenComplete(() {

      if(_News_users_notifications_settingController.status == true){
          setState(() {
          data=_News_users_notifications_settingController.data;
          notification_activation=data["data"]["active_notification"] ?? 0;
          if(notification_activation == 1){
            notification_activation_status = true;
          }
          else{
            notification_activation_status = false;
          }
          notification_type_value=data["data"]["notification_type"].toString() ?? "";
        });
        Future.delayed(Duration.zero, () => hideLoaderDialogFunction(context));
      }else{
        ShowToast('warning',_News_users_notifications_settingController.message);
        Future.delayed(Duration.zero, () => hideLoaderDialogFunction(context));
      }

      data_is_loaded = true;
    });

  }




  @override
  Future<void> initState()  {
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
         language =="en" ? messages_en.getTranslation("News_users_notifications_settings") : messages_ar.getTranslation("News_users_notifications_settings"),
          style: Theme.of(context).textTheme.title,
        ),
        centerTitle: true,
        leading: IconButton(icon:Icon(Icons.arrow_back),
        onPressed:() => Navigator.of(context).push(
        MaterialPageRoute(builder: (context) => Home())
        ),
        ),
      ),

      body: Container(
              child: ListView(
              padding: EdgeInsets.all(10.0),
                                children: <Widget>[


                                  data_is_loaded == true ? Row(
                                    children: [
                                      Flexible(
                                        child:
                                        Row(
                                          children: [
                                            Icon(Icons.add_alert_outlined),
                                            Padding(
                                              padding: const EdgeInsets.only(right: 20.0,left: 20.0),
                                              child: Text(
                                                  language =="en" ? messages_en.getTranslation("active_notification") : messages_ar.getTranslation("active_notification"),
                                              ),
                                            ),
                                          ],
                                        ),
                                      ),
                                      SizedBox(
                                        width: screenHightRatio.toDouble() * 5 ,
                                      ),
                                      CustomSwitch(
                                        activeColor: Colors.pinkAccent,
                                        value: notification_activation_status,
                                        onChanged: (value) {
                                          setState((){
                                            notification_activation_status = value;
                                            if(value == true){
                                              notification_activation = 1;
                                            }
                                            else{
                                              notification_activation =0;
                                            }
                                          });
                                          _onPressedUpdate();

                                        },
                                      ),
                                    ],
                                  ) : SizedBox(),


                                  data_is_loaded == true ? SmartSelect<String>.single(
                                    title: language == "en"
                                        ? messages_en.getTranslation("notification_type")
                                        : messages_ar.getTranslation("notification_type"),
                                    value: notification_type_value,
                                    choiceItems: notification_typesList,
                                    choiceType: S2ChoiceType.radios,
                                    modalType: S2ModalType.popupDialog,
                                    tileBuilder: (context, state) {
                                      return S2Tile.fromState(
                                        state,
                                        isTwoLine: true,
                                        leading: Icon(Icons.art_track),
                                        padding: EdgeInsets.all(0.0),
                                      );
                                    },
                                    modalFilter: true,
                                    onChange: (state) {
                                        setState(() {
                                           notification_type_value = state.value;
                                        });
                                        _onPressedUpdate();
                                      },
                                    modalConfig:S2ModalConfig(
                                      filterAuto: true,
                                    ) ,
                                  ): SizedBox(),


                            ]
                            ),
                    )
    );
  }
}

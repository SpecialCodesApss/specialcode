//
// import '../../Controllers/Admin_messageController.dart';
// import '../../helpers/LoaderDialog.dart';
// import '../../helpers/ToastHelper.dart';
// import '../../helpers/LanguageHelper.dart' as LanguageHelper;
// import '../../main.dart';
// import '../../helpers/SizeConfig.dart';
// import 'package:flutter/widgets.dart';
// import 'package:flutter/material.dart';
// import '../Home.dart';
// import 'dart:async';
// import 'dart:io';
// import 'package:flutter/cupertino.dart';
// import 'package:flutter/src/widgets/basic.dart';
// import 'package:image_picker/image_picker.dart';
//
// // import '../../Views/admin_messages/index.dart';
//
// class Admin_messagesStore extends StatefulWidget {
//   @override
//   State<StatefulWidget> createState() {
//     // TODO: implement createState
//     return _Admin_messagesStoreState();
//   }
// }
//
// class _Admin_messagesStoreState extends State<Admin_messagesStore>{
//   //declare variables here
//
// var language = LanguageHelper.Language;
//   var data;
//
//
//                     var image;
//                     Future getImage() async {
//                       FocusScopeNode currentFocus = FocusScope.of(context);
//                       if (!currentFocus.hasPrimaryFocus) {
//                         currentFocus.unfocus();
//                       }
//                       var picked_image = await ImagePicker.platform.pickImage(source: ImageSource.gallery);
//                       setState(() {
//                         image = File(picked_image!.path);
//                       });
//                     }
//
//
//
//   Admin_messageController _Admin_messageController = new Admin_messageController();
//
//   final TextEditingController _fullnameController = new TextEditingController();final TextEditingController _emailController = new TextEditingController();final TextEditingController _mobileController = new TextEditingController();final TextEditingController _message_typeController = new TextEditingController();final TextEditingController _messages_textController = new TextEditingController();final TextEditingController _open_statusController = new TextEditingController();final TextEditingController _marked_as_readedController = new TextEditingController();final TextEditingController _marked_as_deletedController = new TextEditingController();
//
//   _onPressedStore(){
//     setState(() {
//       showLoaderDialogFunction(context);
//       if(_fullnameController.text.trim().isNotEmpty&&_emailController.text.trim().isNotEmpty&&_mobileController.text.trim().isNotEmpty&&_message_typeController.text.trim().isNotEmpty&&_messages_textController.text.trim().isNotEmpty&&_open_statusController.text.trim().isNotEmpty&&_marked_as_readedController.text.trim().isNotEmpty&&_marked_as_deletedController.text.trim().isNotEmpty){
//         _Admin_messageController.store(_fullnameController.text.trim(),_emailController.text.trim(),_mobileController.text.trim(),_message_typeController.text.trim(),image,_messages_textController.text.trim(),_open_statusController.text.trim(),_marked_as_readedController.text.trim(),_marked_as_deletedController.text.trim()).whenComplete((){
//           if(_Admin_messageController.status == true){
//             hideLoaderDialogFunction(context);
//             ShowToast('success',_Admin_messageController.message);
//             Navigator.push(
//                 context,
//                 MaterialPageRoute(builder: (context) =>Home())
//             );
//           }else{
//             hideLoaderDialogFunction(context);
//             ShowToast('warning',_Admin_messageController.message);
//           }
//         });
//       }
//       else{
//         hideLoaderDialogFunction(context);
//         ShowToast('error',
//         LanguageHelper.trans("app","pleasefillallfields"));
//       }
//     });
//   }
//
//   read() async {
//     await LanguageHelper.initialize();
//     language = LanguageHelper.Language;
//   }
//
//
//   @override
//   void initState() {
//     // TODO: implement initState
//     super.initState();
//     read();
//   }
//   @override
//   void dispose() {
//     // TODO: implement dispose
//     super.dispose();
//   }
//
//   @override
//   Widget build(BuildContext context) {
//     // TODO: implement build
//     SizeConfig().init(context); // for media query
//     var screenWidthRatio = 10;
//     var screenHightRatio = 35;
//     var contenttopalignmentratio=20;
//     if(SizeConfig.orientation == Orientation.landscape){
//       screenWidthRatio = 20 ;
//       screenHightRatio = 55 ;
//
//       contenttopalignmentratio=10;
//     }
//     else{
//       screenWidthRatio = 10 ;
//       screenHightRatio = 35 ;
//
//       contenttopalignmentratio=3;
//     }
// return Scaffold(
//       appBar: AppBar(
//         title:Text(
//         LanguageHelper.trans("admin_messages","Admin_messages"),
//           style: Theme.of(context).textTheme.subtitle1,
//         ),
//         centerTitle: true,
//         leading: IconButton(icon:Icon(Icons.arrow_back),
//         onPressed:() => Navigator.of(context).push(
//         MaterialPageRoute(builder: (context) => Home())
//         ),
//         ),
//       ),
//
//       body: Container(
//         child: ListView(
//         padding: EdgeInsets.all(10.0),
//                           children: <Widget>[
//                             TextField(
//                                                       controller: _fullnameController,
//                                                       style: Theme.of(context).textTheme.bodyText1,
//                                                       keyboardType: TextInputType.text,
//                                                       decoration: InputDecoration(
//                                                         icon: Icon(Icons.arrow_left),
//                                                         hintText:
//                                                         LanguageHelper.trans("admin_messages","fullname"),
//                                                         labelText:LanguageHelper.trans("admin_messages","fullname"),
//                                                       ),
//                                                     ),
//                                             TextField(
//                                                       controller: _emailController,
//                                                       style: Theme.of(context).textTheme.bodyText1,
//                                                       keyboardType: TextInputType.text,
//                                                       decoration: InputDecoration(
//                                                         icon: Icon(Icons.arrow_left),
//                                                         hintText:
//                                                         LanguageHelper.trans("admin_messages","email"),
//                                                         labelText:LanguageHelper.trans("admin_messages","email"),
//                                                       ),
//                                                     ),
//                                             TextField(
//                                                       controller: _mobileController,
//                                                       style: Theme.of(context).textTheme.bodyText1,
//                                                       keyboardType: TextInputType.text,
//                                                       decoration: InputDecoration(
//                                                         icon: Icon(Icons.arrow_left),
//                                                         hintText:
//                                                         LanguageHelper.trans("admin_messages","mobile"),
//                                                         labelText:LanguageHelper.trans("admin_messages","mobile"),
//                                                       ),
//                                                     ),
//                                             TextField(
//                                                       controller: _message_typeController,
//                                                       style: Theme.of(context).textTheme.bodyText1,
//                                                       keyboardType: TextInputType.text,
//                                                       decoration: InputDecoration(
//                                                         icon: Icon(Icons.arrow_left),
//                                                         hintText:
//                                                         LanguageHelper.trans("admin_messages","message_type"),
//                                                         labelText:LanguageHelper.trans("admin_messages","message_type"),
//                                                       ),
//                                                     ),
//                                             TextField(
//                                                       controller: _messages_textController,
//                                                       style: Theme.of(context).textTheme.bodyText1,
//                                                       keyboardType: TextInputType.text,
//                                                       decoration: InputDecoration(
//                                                         icon: Icon(Icons.arrow_left),
//                                                         hintText:
//                                                         LanguageHelper.trans("admin_messages","messages_text"),
//                                                         labelText:LanguageHelper.trans("admin_messages","messages_text"),
//                                                       ),
//                                                     ),
//                                             TextField(
//                                                       controller: _open_statusController,
//                                                       style: Theme.of(context).textTheme.bodyText1,
//                                                       keyboardType: TextInputType.text,
//                                                       decoration: InputDecoration(
//                                                         icon: Icon(Icons.arrow_left),
//                                                         hintText:
//                                                         LanguageHelper.trans("admin_messages","open_status"),
//                                                         labelText:LanguageHelper.trans("admin_messages","open_status"),
//                                                       ),
//                                                     ),
//                                             TextField(
//                                                       controller: _marked_as_readedController,
//                                                       style: Theme.of(context).textTheme.bodyText1,
//                                                       keyboardType: TextInputType.text,
//                                                       decoration: InputDecoration(
//                                                         icon: Icon(Icons.arrow_left),
//                                                         hintText:
//                                                         LanguageHelper.trans("admin_messages","marked_as_readed"),
//                                                         labelText:LanguageHelper.trans("admin_messages","marked_as_readed"),
//                                                       ),
//                                                     ),
//                                             TextField(
//                                                       controller: _marked_as_deletedController,
//                                                       style: Theme.of(context).textTheme.bodyText1,
//                                                       keyboardType: TextInputType.text,
//                                                       decoration: InputDecoration(
//                                                         icon: Icon(Icons.arrow_left),
//                                                         hintText:
//                                                         LanguageHelper.trans("admin_messages","marked_as_deleted"),
//                                                         labelText:LanguageHelper.trans("admin_messages","marked_as_deleted"),
//                                                       ),
//                                                     ),
//
//
//                     image != null ?
//                             Image.file(image,width: 150,height: 150,)
//                             :Text(
//                                 LanguageHelper.trans("app","noImageSelected")
//                             ),
//                                   RaisedButton(
//                                     onPressed: getImage,
//                                     child: Icon(
//                                       Icons.add_a_photo,
//                                       color: Colors.white,
//                                     ),
//                                   ),
//
//
//                         SizedBox(
//                           height: 20,
//                         ),
//                         RaisedButton(
//                           color: Theme.of(context).primaryColor ,
//                           child:  Text(
//                           LanguageHelper.trans("app","create"),
//                             style: Theme.of(context).textTheme.button,
//                           ),
//                           onPressed: _onPressedStore,
//                         ),
//                       ]
//                       ),
//               )
//     );
//   }
// }

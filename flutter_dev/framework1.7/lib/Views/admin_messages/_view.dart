//
//         import '../../Controllers/Admin_messageController.dart';
// import '../../helpers/LoaderDialog.dart';
// import '../../helpers/ToastHelper.dart';
// import '../../helpers/LanguageHelper.dart' as LanguageHelper;
// import '../../main.dart';
// import '../../helpers/SizeConfig.dart';
// import 'package:flutter/widgets.dart';
// import 'package:flutter/material.dart';
// import '../Home.dart';
// import 'package:carousel_slider/carousel_slider.dart';
//
// import '../../Views/admin_messages/index.dart';
// import '../../Views/admin_messages/update.dart';
//
//
// class Admin_messagesView extends StatefulWidget {
//
//   final int id;
//   Admin_messagesView(this.id);
//
//   @override
//   State<StatefulWidget> createState() {
//     // TODO: implement createState
//     return _Admin_messagesViewState();
//   }
// }
//
// class _Admin_messagesViewState extends State<Admin_messagesView>{
//   //declare variables here
// var language = LanguageHelper.Language;
//     final List<String> imgList = [];
//     bool ViewImage = true;
//     String ViewedImageType = "slider";
//   var data;
//
//   Admin_messageController _Admin_messageController = new Admin_messageController();
//   read() async {
//
//   await LanguageHelper.initialize();
//     language = LanguageHelper.Language;
//
//     //get  data
//     Future.delayed(Duration.zero, () => showLoaderDialogFunction(context));
//     _Admin_messageController.view(widget.id).whenComplete((){
//       if(_Admin_messageController.status == true){
//         setState(() {
//           data = _Admin_messageController.data;
//         });
//         Future.delayed(Duration.zero, () => hideLoaderDialogFunction(context));
//       }else{
//         ShowToast('warning',_Admin_messageController.message);
//         Future.delayed(Duration.zero, () => hideLoaderDialogFunction(context));
//       }
//     });
//   }
//
//   deleteItem() async {
//       showLoaderDialogFunction(context);
//         _Admin_messageController.delete(widget.id).whenComplete((){
//           if(_Admin_messageController.status == true){
//             setState(() {
//                 ShowToast('success',_Admin_messageController.message);
//                 hideLoaderDialogFunction(context);
//                 Navigator.push(
//                     context,
//                     MaterialPageRoute(builder: (context) =>Admin_messagesIndex())
//                 );
//             });
//           }else{
//             ShowToast('warning',_Admin_messageController.message);
//             hideLoaderDialogFunction(context);
//           }
//         });
//     }
//
//     delete () async {
//       showDialog(
//           context: context,
//           barrierDismissible: false,
//           builder: (BuildContext context) {
//             return AlertDialog(
//               title: Center(child: Text(LanguageHelper.trans("app","Alert"))),
//               content: Column(
//                 mainAxisSize: MainAxisSize.min,
//                 children: <Widget>[
//                   Container(
//                     padding: EdgeInsets.only(bottom: 30.0),
//                     child: Text(
//                     LanguageHelper.trans("app","confirmDeleteMessage"),
//                       textAlign: TextAlign.center,
//                       style: TextStyle(
//                         color: Colors.red,
//                       ),
//                     ),
//                   ),
//                   Row(
//                       mainAxisAlignment: MainAxisAlignment.spaceBetween,
//                       children: <Widget>[
//                         FlatButton(
//                         child: Text(
//                         LanguageHelper.trans("app","yes")
//                         ),
//                             onPressed: () {
//                               deleteItem();
//                             }),
//                         FlatButton(
//                             child: Text(
//                              LanguageHelper.trans("app","no")
//                              ),
//                             autofocus: true,
//                             color: Theme.of(context).primaryColor,
//                             textColor: Colors.white,
//                             onPressed: () {
//                               Navigator.of(context).pop();
//                             })
//                       ])
//                 ],
//               ),
//             );
//           });
//     }
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
//
//     return Scaffold(
//       appBar: AppBar(
//         title:Text(
//         LanguageHelper.trans("admin_messages","Admin_messages"),
//           style: Theme.of(context).textTheme.subtitle1,
//         ),
//         centerTitle: true,
//         leading: IconButton(icon:Icon(Icons.arrow_back),
//         onPressed:() => Navigator.of(context).push(
//         MaterialPageRoute(builder: (context) => Admin_messagesIndex())
//         ),
//         ),
//       ),
//
//         body: Container(
//             child: data != null ? ListView(
//               padding: EdgeInsets.all(5.0),
//                 children: <Widget>[
//                   ViewImage==true ? CarouselSlider(
//                     options:  CarouselOptions(
//                       viewportFraction: 1.0,
//                       enlargeCenterPage: false,
//                       autoPlay: ViewedImageType=="slider" ? false : false,
//                       autoPlayInterval: Duration(seconds: 3),
//                     ),
//                     items: imgList.map((item) => Container(
//                       child: Center(
//                           child: Image.network(item, fit: BoxFit.cover, width: 1000)
//                       ),
//                     )).toList(),
//                   ) : SizedBox(),
//                   Text(
//                   LanguageHelper.trans("app","theImage"),
//                     style: Theme.of(context).textTheme.bodyText1,
//                     textAlign: TextAlign.center,
//                   ),
//
//                   Padding(
//                   padding: EdgeInsets.only(top:20.0,right: 0.0),
//                   child:Directionality(
//                     textDirection: language =="ar" ? TextDirection.rtl : TextDirection.ltr,
//                     child: Text(
//                     LanguageHelper.trans("app","title"),
//                       style: TextStyle(fontWeight: FontWeight.bold),
//                       textDirection: language =="ar" ? TextDirection.rtl : TextDirection.ltr,
//                     ),
//                   )
//                   ),
//                   Text(
//
//                       data["data"]["id"].toString()+
//                        LanguageHelper.trans("app","SARcurrency"),
//                   ),
//
//                   Table(
//                       children:[
//                         TableRow(
//                             children: [
//                               Text(
//                                LanguageHelper.trans("admin_messages","id"),
//                                 style: TextStyle(fontWeight: FontWeight.bold),
//                               ),
//                               Text(
//                                   data["data"]["id"].toString()
//                               ),
//                             ]
//                         ),
//                         TableRow(
//                             children: [
//                               Text(
//                               LanguageHelper.trans("admin_messages","id"),
//                                 style: TextStyle(fontWeight: FontWeight.bold),
//                               ),
//                               Text(
//                                   data["data"]["id"].toString()
//                               ),
//                             ]
//                         ),
//                         TableRow(
//                             children: [
//                               Text(
//                               LanguageHelper.trans("admin_messages","id"),
//                                 style: TextStyle(fontWeight: FontWeight.bold),
//                               ),
//                               Text(
//                                   data["data"]["id"].toString()
//                               ),
//                             ]
//                         ),
//
//                       ]
//                   ),
//
//
//             Padding(
//                       padding: EdgeInsets.only(top:50.0,left: 30.0,right: 30.0),
//                       child: RaisedButton(
//                           color: Theme.of(context).primaryColor ,
//                           child:  Text(
//                           LanguageHelper.trans("app","order"),
//                             style: Theme.of(context).textTheme.button,
//                           ),
//                           onPressed: null
//                       ),
//                   ),
//
//
//             Padding(
//                     padding: EdgeInsets.only(top:50.0,left: 30.0,right: 30.0),
//                     child: Row(
//                       children: <Widget>[
//                         Padding(
//                           padding: EdgeInsets.only(left: 30.0,right: 30.0),
//                         child: RaisedButton(
//                           color: Theme.of(context).primaryColor ,
//                           child:  Text(
//                           LanguageHelper.trans("app","edit"),
//                             style: Theme.of(context).textTheme.button,
//                           ),
//                           onPressed:() => Navigator.of(context).push(
//                               MaterialPageRoute(builder: (context) => Admin_messagesUpdate(widget.id))
//                           ),
//                           padding: EdgeInsets.only(left: 30.0,right: 30.0),
//                         ),
//                         ),
//                         Padding(
//                       padding: EdgeInsets.only(left: 30.0,right: 30.0),
//                       child:RaisedButton(
//                             color: Colors.red ,
//                             child:  Text(
//                             LanguageHelper.trans("app","delete"),
//                               style: Theme.of(context).textTheme.button,
//                             ),
//                           onPressed:() => delete(),
//                           padding: EdgeInsets.only(left: 30.0,right: 30.0),
//                         ),
//                       ),
//                       ],
//                     )
//                   )
//
//                 ],
//               ): null ,
//             )
//     );
//
//   }
// }

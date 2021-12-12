import '../../Controllers/B_testController.dart';
import 'package:flutter/cupertino.dart';
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
import '../../packages/flutter_staggered_animations/lib/flutter_staggered_animations.dart';
import '../../packages/flutter_pulltorefresh/lib/pull_to_refresh.dart';
import '../../packages/simples_search_bar/lib/simple_search_bar.dart';

import '../../Views/b_tests/view.dart';
import '../../Views/b_tests/store.dart';

class B_testsIndex extends StatefulWidget {
  @override
  State<StatefulWidget> createState() {
    // TODO: implement createState
    return _B_testsIndexState();
  }
}

class _B_testsIndexState extends State<B_testsIndex>{
  //declare variables here
  var language = LanguageHelper.Language;
  List data;
  bool isNoListData=true;
  bool ViewAddButton=true;
  bool ViewSearchBar=true;
  bool isAdImageEnabled=true;
  String searchText="";
  var Ad;
  String viewType = "ListView";
    int count = 1 ;
    int pagesCount = 1 ;
    int newPage = 2;
  B_testController _B_testController = new B_testController();
    final AppBarController appBarController = AppBarController();

  RefreshController _refreshController =
    RefreshController(initialRefresh: false);

    void _onRefresh() async {
      // monitor network fetch
      await Future.delayed(Duration(milliseconds: 1000));
      // if failed,use refreshFailed()
      //get list data
            _B_testController.index(1,searchText).whenComplete((){
              if(_B_testController.status == true){
                setState(() {
                  data = _B_testController.listData;
                  if(data.length > 0){
                    isNoListData=false;
                    pagesCount = _B_testController.data["data"]["last_page"];
                  }
                });
              }else{
                ShowToast("warning",_B_testController.message);
              }
            });
      _refreshController.refreshCompleted();
    }

    void _onLoading() async {
      // monitor network fetch
      await Future.delayed(Duration(milliseconds: 1000));
      // if failed,use loadFailed(),if no data return,use LoadNodata()
      if (mounted)
        _B_testController.index(newPage,searchText).whenComplete((){
          if(_B_testController.status == true){
            setState(() {
              data.addAll(_B_testController.listData);
              newPage++;
            });
          }
          else{
            _refreshController.loadFailed();
          }
        });

      if(newPage > pagesCount){
        _refreshController.loadNoData();
      }
      else{
        _refreshController.loadComplete();
      }

    }

    void _onSearch(String Text){
          setState(() {
            searchText = Text;
            data=null;
            pagesCount = 1 ;
            newPage = 2;
            _refreshController.resetNoData();
            _onRefresh();
          });
        }

  read() async {
    //get list data
    Future.delayed(Duration.zero, () => showLoaderDialogFunction(context));
    _B_testController.index(1,searchText).whenComplete((){
      if(_B_testController.status == true){
        setState(() {
          data = _B_testController.listData;
          if(data.length > 0){
            isNoListData=false;
            pagesCount = _B_testController.data["data"]["last_page"];
          }
        });
        Future.delayed(Duration.zero, () => hideLoaderDialogFunction(context));
      }else{
        ShowToast('warning',_B_testController.message);
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
      appBar: ViewSearchBar==true ?
            SearchAppBar(
              primary: Theme.of(context).primaryColor,
              appBarController: appBarController,
              // You could load the bar with search already active
              autoSelected: false,
              searchHint: language =="en" ? messages_en.getTranslation("searchHereurrency") : messages_ar.getTranslation("searchHere"),
              mainTextColor: Colors.white,
              onChange: (String value) {
                 _onSearch(value);
              },
              mainAppBar: AppBar(
                title: Text(
                language =="en" ? messages_en.getTranslation("B_tests") : messages_ar.getTranslation
                                              ("B_tests"),
                  style: Theme.of(context).textTheme.title,
                ),
                centerTitle: true,
		leading: IconButton(icon:Icon(Icons.arrow_back),
                  onPressed:() => Navigator.of(context).push(
                      MaterialPageRoute(builder: (context) => Home())
                  ),
                ),
                actions: <Widget>[
                  InkWell(
                    child: Icon(
                      Icons.search,
                    ),
                    onTap: () {
                      //This is where You change to SEARCH MODE. To hide, just
                      //add FALSE as value on the stream
                      appBarController.stream.add(true);
                    },
                  ),
                ],
              ),
            )
            :
      AppBar(
        title:Text(
        language =="en" ? messages_en.getTranslation("B_tests") : messages_ar.getTranslation
                                      ("B_tests"),
          style: Theme.of(context).textTheme.title,
        ),
        centerTitle: true,
        leading: IconButton(icon:Icon(Icons.arrow_back),
        onPressed:() => Navigator.of(context).push(
        MaterialPageRoute(builder: (context) => Home())
        ),
        ),
      ),

      body: isNoListData ?
      Container(
        child: Center(
          child: Text(
            language =="en" ? messages_en.getTranslation("NoListData") : messages_ar.getTranslation("NoListData"),
            style: Theme.of(context).textTheme.body1,
          ),
        ),
      )
    : Column(
            children: <Widget>[

              Expanded(child:
              AnimationLimiter(
                child :SmartRefresher(
                  enablePullDown: true,
                  enablePullUp: true,
                  header: WaterDropMaterialHeader(),
                  footer: CustomFooter(
                    builder: (BuildContext context, LoadStatus mode) {
                      Widget body;
                        if (mode == LoadStatus.idle) {
                          body = Text(language =="en" ? messages_en.getTranslation("pullupload") : messages_ar.getTranslation("pullupload"));
                        }
                        else if (mode == LoadStatus.loading) {
                          body = CupertinoActivityIndicator();
                        }
                        else if (mode == LoadStatus.failed) {
                          body = Text(language =="en" ? messages_en.getTranslation("pullupload") : messages_ar.getTranslation("loadFailed"));
                        }
                        else if (mode == LoadStatus.canLoading) {
                          body = Text(language =="en" ? messages_en.getTranslation("releaseToloadMore") : messages_ar.getTranslation("releaseToloadMore"));
                        }
                        else {
                          body = Text(language =="en" ? messages_en.getTranslation("NomoreData") : messages_ar.getTranslation("NomoreData"));
                        }
                      return Container(
                        height: 55.0,
                        child: Center(child: body),
                      );
                    },
                  ),
                  controller: _refreshController,
                  onRefresh: _onRefresh,
                  onLoading: _onLoading,
                  child: ListView.builder(
                    itemCount: data == null ? 0 : data.length,
                    itemBuilder: (BuildContext context, int index){
                      return AnimationConfiguration.staggeredList(
                        position: index,
                        duration: const Duration(milliseconds: 375),
                        child: SlideAnimation(
                          verticalOffset: 50.0,
                          child: FadeInAnimation(
                            child: InkWell(
                              onTap: () {
                                Navigator.of(context).push(
                                    MaterialPageRoute(builder: (context) => B_testsView(data[index]["id"]))
                                );
                              },
                              child: Container(
                                  margin: const EdgeInsets.all(5.0),
                                  padding: const EdgeInsets.only(left: 5.0,right: 5.0,top: 10.0,bottom: 10.0),
                                  decoration: BoxDecoration(
                                      borderRadius: BorderRadius.all(
                                          Radius.circular(10.0)
                                      ),
                                      border: Border.all(color: Colors.black12)
                                  ),
                                  alignment: language == "en" ? Alignment.centerLeft : Alignment.centerRight  ,
                                  child:
                                  Column(
                                    children: <Widget>[
                                      Row(
                                        textDirection: TextDirection.rtl ,
                                        children: <Widget>[
                                          Padding(
                                            padding: EdgeInsets.only(right: 10.0 , left: 10.0 , top: 0.0) ,
                                            child: Text(
                                              data[index]["id"],
                                              style: Theme.of(context).textTheme.subtitle,
                                            ),
                                          ),
                                        ],
                                      ),

                                      Row(
                                        textDirection: TextDirection.rtl ,
                                        children: <Widget>[Padding(
                                            padding: EdgeInsets.only(right: 10.0 , left: 10.0 , top: 0.0) ,
                                            child: Text(
                                               language =="en" ? messages_en.getTranslation("SARcurrency") : messages_ar.getTranslation("SARcurrency")+data[index]["id"].toString() ,
                                              style: Theme.of(context).textTheme.display1,
                                            ),
                                          ),
                                        ],
                                      ),

                                    ],
                                  )
                              ),
                            ),
                          ),
                        ),
                      );
                    },
                  ),
                ),
              ),
              ),
            ],
          ),
          floatingActionButton: ViewAddButton==true ? FloatingActionButton(
            child: Icon(Icons.add),
            onPressed: () {
            Navigator.of(context).push(
            MaterialPageRoute(builder: (context) => B_testsStore())
            );
         }) : null ,
        );
  }
}

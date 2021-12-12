import 'package:framework_01_6/Controllers/Wallets_withdrawalController.dart';
import 'package:flutter/cupertino.dart';
import 'package:framework_01_6/helpers/LoaderDialog.dart';
import 'package:framework_01_6/helpers/ToastHelper.dart';
import 'package:framework_01_6/helpers/SizeConfig.dart';
import 'package:flutter/widgets.dart';
import 'package:flutter/material.dart';
import '../Home.dart';
import '../../packages/flutter_staggered_animations/lib/flutter_staggered_animations.dart';
import '../../packages/flutter_pulltorefresh/lib/pull_to_refresh.dart';
import '../../packages/simples_search_bar/lib/simple_search_bar.dart';
import 'package:framework_01_6/Views/wallets_withdrawals/view.dart';
import 'package:framework_01_6/Views/wallets_withdrawals/store.dart';
import 'package:framework_01_6/helpers/LanguageHelper.dart' as LanguageHelper;
import '../../lang/ar/wallets.dart' as messages_ar;
import '../../lang/en/wallets.dart' as messages_en;

class Wallets_withdrawalsIndex extends StatefulWidget {
  @override
  State<StatefulWidget> createState() {
    // TODO: implement createState
    return _Wallets_withdrawalsIndexState();
  }
}

class _Wallets_withdrawalsIndexState extends State<Wallets_withdrawalsIndex>{
  //declare variables here
  var language = LanguageHelper.Language;
  List data;
  bool isNoListData=true;
  bool ViewAddButton=true;
  bool ViewSearchBar=true;
  bool isAdImageEnabled=false;
  String searchText="";
  var Ad;
  String viewType = "ListView";
    int count = 1 ;
    int pagesCount = 1 ;
    int newPage = 2;
  Wallets_withdrawalController _Wallets_withdrawalController = new Wallets_withdrawalController();
    final AppBarController appBarController = AppBarController();

  RefreshController _refreshController =
    RefreshController(initialRefresh: false);

    void _onRefresh() async {
      // monitor network fetch
      await Future.delayed(Duration(milliseconds: 1000));
      // if failed,use refreshFailed()
      //get list data
            _Wallets_withdrawalController.index(1,searchText).whenComplete((){
              if(_Wallets_withdrawalController.status == true){
                setState(() {
                  data = _Wallets_withdrawalController.listData;
                  if(data.length > 0){
                    isNoListData=false;
                    pagesCount = _Wallets_withdrawalController.data["data"]["last_page"];
                  }
                });
              }else{
                ShowToast("warning",_Wallets_withdrawalController.message);
              }
            });
      _refreshController.refreshCompleted();
    }

    void _onLoading() async {
      // monitor network fetch
      await Future.delayed(Duration(milliseconds: 1000));
      // if failed,use loadFailed(),if no data return,use LoadNodata()
      if (mounted)
        _Wallets_withdrawalController.index(newPage,searchText).whenComplete((){
          if(_Wallets_withdrawalController.status == true){
            setState(() {
              data.addAll(_Wallets_withdrawalController.listData);
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
    _Wallets_withdrawalController.index(1,searchText).whenComplete((){
      if(_Wallets_withdrawalController.status == true){
        setState(() {
          data = _Wallets_withdrawalController.listData;
          if(data.length > 0){
            isNoListData=false;
            pagesCount = _Wallets_withdrawalController.data["data"]["last_page"];
          }
        });
        Future.delayed(Duration.zero, () => hideLoaderDialogFunction(context));
      }else{
        ShowToast('warning',_Wallets_withdrawalController.message);
        Future.delayed(Duration.zero, () => hideLoaderDialogFunction(context));
      }
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
      appBar: ViewSearchBar==true ?
            SearchAppBar(
              primary: Theme.of(context).primaryColor,
              appBarController: appBarController,
              // You could load the bar with search already active
              autoSelected: false,
              searchHint: language =="en" ? messages_en.getTranslation("searchHere") : messages_ar.getTranslation
                ("searchHere"),
              mainTextColor: Colors.white,
              onChange: (String value) {
                 _onSearch(value);
              },
              mainAppBar: AppBar(
                title: Text(
                  language =="en" ? messages_en.getTranslation("Wallets_withdrawals") : messages_ar.getTranslation
                    ("Wallets_withdrawals"),
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
          language =="en" ? messages_en.getTranslation("Wallets_withdrawals") : messages_ar.getTranslation
            ("Wallets_withdrawals"),
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
            language =="en" ? messages_en.getTranslation("NoListData") : messages_ar.getTranslation
              ("NoListData"),
            style: Theme.of(context).textTheme.body1,
          ),
        ),
      )
    : Column(
            children: <Widget>[
              isAdImageEnabled ? InkWell(
                  onTap: () {
                    Navigator.of(context).push(
                        MaterialPageRoute(builder: (context) => null)
                    );
                  },
                  child: Image.network(
                    "https://doctorn.app/"+Ad["ad_image"].toString(),
                  )
              )  : SizedBox(),
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
                        body = Text(
                            language =="en" ? messages_en.getTranslation("pullupload") : messages_ar.getTranslation
                              ("pullupload")
                        );
                      }
                      else if (mode == LoadStatus.loading) {
                        body = CupertinoActivityIndicator();
                      }
                      else if (mode == LoadStatus.failed) {
                        body = Text(language =="en" ? messages_en.getTranslation("loadFailed") : messages_ar.getTranslation
                          ("loadFailed"));
                      }
                      else if (mode == LoadStatus.canLoading) {
                        body = Text(language =="en" ? messages_en.getTranslation("releaseToloadMore") : messages_ar.getTranslation
                          ("releaseToloadMore"));
                      }
                      else {
                        body = Text(language =="en" ? messages_en.getTranslation("NomoreData") : messages_ar.getTranslation
                          ("NomoreData"));
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
                                    MaterialPageRoute(builder: (context) => Wallets_withdrawalsView(data[index]["id"]))
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
                                              data[index]["created_at"],
                                              style: Theme.of(context).textTheme.subtitle,
                                            ),
                                          ),
                                        ],
                                      ),

                                      Row(
                                        textDirection: TextDirection.rtl ,
                                        children: <Widget>[
                                          Padding(
                                            padding: EdgeInsets.only(right: 10.0 , left: 10.0 , top: 0.0) ,
                                            child: Text(
                                              language =="en" ? messages_en.getTranslation("SARcurrency") : messages_ar.getTranslation
                                                ("SARcurrency")+data[index]["withdrawal_amount_required"].toString() ,
                                              style: Theme.of(context).textTheme.display1,
                                            ),
                                          ),
                                          Padding(
                                            padding: EdgeInsets.only(right: screenWidthRatio*1.5 , left: screenWidthRatio*1.5 , top: 0.0) ,
                                            child: Text(
                                              data[index]['money_withdrawal_status'] ,
                                              style: TextStyle(
                                                fontSize: 16.0,
                                                fontWeight: FontWeight.bold,
                                                color: Colors.green,
                                              ),
                                            ),
                                          ),
                                          Padding(
                                            padding: EdgeInsets.only(right: screenWidthRatio*1.0 , left: screenWidthRatio*1.0 , top: 0.0) ,
                                            child: Text(
                                              data[index]["bank_name"].toString() ,
                                              style: TextStyle(
                                                fontSize: 16.0,
                                                fontWeight: FontWeight.bold,
                                                color: Colors.red,
                                              ),
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
            MaterialPageRoute(builder: (context) => Wallets_withdrawalsStore())
            );
         }) : null ,
        );
  }
}

import { Component, OnInit } from '@angular/core';
import { User, DbConfig, Select } from '@app/_modules/dtos';
import { AccountService, DbEditorService } from '@app/_modules/services';
import { FormBuilder, FormGroup } from '@angular/forms';
import {MessageService} from 'primeng/api';

@Component({ templateUrl: 'home.component.html'})
export class HomeComponent implements OnInit{
    user: User | null;
    dbConfig: DbConfig = {} as DbConfig;
    listForm: any = {  

    DBDriver: "select:dbtype",
    database: "text",
    DBPrefix: "text",

    hostname: "text",
    username: "text",
    password: "text",

    port: "numeric",
    pConnect: "boolean",
    DBDebug:"boolean",

    encrypt: "boolean",
    compress:"boolean",
    strictOn: "boolean",

    charset: "text",
    DBCollat: "text",
    DSN: "text"
    };

    databases: Select[] = [
        {value: "", name: "No Db Selected"},
        {value: "SQLite3", name: "SQLite 3"},
        {value: "MySQLi", name: "MySQL or MariaDb"},
        {value: "Postgre", name: "Postgre SQL"},
        {value: "OCI8", name: "Oracle (OCI8) (requires php binary driver)"},
        {value: "SQLSRV", name: "Microsoft SQL"},
    ];

    listFormKeys: any  = Object.keys(this.listForm);
    formDb!: FormGroup;

    constructor(private accountService: AccountService, 
        private dbeditor: DbEditorService,
        private formBuilder: FormBuilder,
        private messageService: MessageService
        ) {
        this.user = this.accountService.userValue;
    }

    ngOnInit(): void {
        this.getDbConfig();
    }

    buildForm(db: DbConfig){
        db.DBDriver = (this.databases.filter(x=>x.value=db.DBDriver)[0] == undefined)?db.DBDriver:'';
        return this.formBuilder.group(db);
    }

    getDbConfig(): void {
        this.dbeditor.dbinfo().subscribe({
            next: e =>{
                this.dbConfig = e;
                this.formDb = this.buildForm(e);
            }
        })
    }

    onSubmit(): void {

    }

    checkDb(){

    }

}
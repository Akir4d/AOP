import { Component, OnInit } from '@angular/core';
import { User, DbConfig, Select } from '@app/_modules/dtos';
import { AccountService, DbEditorService } from '@app/_modules/services';
import { FormBuilder, FormGroup } from '@angular/forms';
import {MessageService} from 'primeng/api';
import {Message} from 'primeng/api';

@Component({ templateUrl: 'home.component.html'})
export class HomeComponent implements OnInit{
    user: User | null;
    dbConfig: DbConfig = {} as DbConfig;
    listForm: any = {  

    DBDriver: {type:"select:dbtype", desc: "DB Driver"},
    database: {type:"text", desc: "Database Name (or SQLite file stored into writable folder)"},
    DBPrefix: {type:"text", desc: "Tables Prefix"},

    hostname: {type:"text", desc: "Hostname (SQLite/DSN leave blank)"},
    username: {type:"text", desc: "Username (SQLite/DSN leave blank)"},
    password: {type:"text", desc: "Password (SQLite/DSN leave blank) "},

    port: {type:"numeric", desc: "Port (default: 3306 for MySQL, 5432 for Postgres, ignored by sqlite)"},
    pConnect: {type:"boolean", desc: "Persistent Connection"},
    DBDebug:{type:"boolean", desc: "Enable Debug Messages"},

    encrypt: {type:"boolean", desc: "Encrypted Connection"},
    compress:{type:"boolean", desc: "Use Client compression (MySQLi only)"},
    strictOn: {type:"boolean", desc: "Strict Mode (MySQLi only)"},

    charset: {type:"text", desc: "Database charset"},
    DBCollat: {type:"text", desc: "DB Collat (MySQLi Only)"},
    DSN: {type:"text", desc: "DSN (all-in-one configuration sequence)"}
    };



    databases: Select[] = [
        {value: "", name: "Select Database driver"},
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
        db.DBDriver = (this.databases.filter(x=>x.value===db.DBDriver) !== undefined)?db.DBDriver:'';
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
        this.dbeditor.saveDbDefault(this.formDb.value).subscribe({
            next: e=>{
                this.messageService.add({
                    severity:e.error?"error":"success", 
                    summary:e.error?'Error':'Saved', 
                    detail:e.message?e.message:"Success!"
                });
            }
        })
    }

    checkDb(): void{
        this.dbeditor.dbTest(this.formDb.value).subscribe({
            next: e=>{
                this.messageService.add({
                    severity:e.error?"error":"success", 
                    summary:e.error?'Error':'Test Connection', 
                    detail:e.message?e.message:"Success!"
                });
            }
        })
    }

}
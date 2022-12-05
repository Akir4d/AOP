import { Component, OnInit } from '@angular/core';
import { User, DbConfig, Select } from '@app/_dtos';
import { AccountService, DbEditorService } from '@app/_services';
import { ActivatedRoute, Router } from '@angular/router';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';

@Component({ templateUrl: 'home.component.html', styleUrls: ['./home.component.scss']})
export class HomeComponent implements OnInit{
    user: User | null;
    dbConfig: DbConfig = {} as DbConfig;
    listForm: any = {   
    DSN: "text",
    hostname: "text",
    username: "text",
    password: "text",
    database: "text",
    DBDriver: "select:dbtype",
    DBPrefix: "text",
    port: "numeric",
    pConnect: "boolean",
    DBDebug:"boolean",
    encrypt: "boolean",
    compress:"boolean",
    strictOn: "boolean",
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
        private route: ActivatedRoute,
        private formBuilder: FormBuilder,
        private router: Router) {
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

}
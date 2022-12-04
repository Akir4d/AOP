import { NgModule } from '@angular/core';
import { ReactiveFormsModule } from '@angular/forms';
import { CommonModule } from '@angular/common';

import { UsersRoutingModule } from './users-routing.module';
import { AdminComponent } from './admin/admin.component';
import {AccordionModule} from 'primeng/accordion';
import {CardModule} from 'primeng/card';
import {InputTextModule} from 'primeng/inputtext';
import {StyleClassModule} from 'primeng/styleclass';
import {ButtonModule} from 'primeng/button';

@NgModule({
    imports: [
        CommonModule,
        ReactiveFormsModule,
        UsersRoutingModule,
        AccordionModule,
        InputTextModule,
        StyleClassModule,
        CardModule,
        ButtonModule
    ],
    declarations: [
        AdminComponent
    ]
})
export class UsersModule { }

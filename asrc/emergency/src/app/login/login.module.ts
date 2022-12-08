import { NgModule } from '@angular/core';
import { ReactiveFormsModule } from '@angular/forms';
import { CommonModule } from '@angular/common';
import { AccountRoutingModule } from './login-routing.module';
import { LoginComponent } from './login.component';
import { AccordionModule } from 'primeng/accordion';
import { CardModule } from 'primeng/card';
import { InputTextModule } from 'primeng/inputtext';
import { StyleClassModule } from 'primeng/styleclass';
import { ButtonModule } from 'primeng/button';
import { MessagesModule } from 'primeng/messages';
import { MessageModule } from 'primeng/message';

@NgModule({
    imports: [
        CommonModule,
        ReactiveFormsModule,
        AccountRoutingModule,
        AccordionModule,
        InputTextModule,
        StyleClassModule,
        CardModule,
        ButtonModule,
        MessagesModule,
        MessageModule
    ],
    declarations: [
        LoginComponent
    ],
    bootstrap: [LoginComponent]
})
export class AccountModule { }

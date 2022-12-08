import { AdminComponent } from '@app/console/admin/admin.component';
import { HomeComponent } from './home/home.component';
import { RouterModule } from '@angular/router';
import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { ConsoleRoutingModule } from './console-routing.module';
import { ConsoleComponent } from './console.component';
import { AccordionModule } from 'primeng/accordion';
import { CardModule } from 'primeng/card';
import { InputTextModule } from 'primeng/inputtext';
import { InputNumberModule } from 'primeng/inputnumber';
import { StyleClassModule } from 'primeng/styleclass';
import { ButtonModule } from 'primeng/button';
import { SidebarComponent } from '@app/console/_components/sidebar/sidebar.component';
import { ReactiveFormsModule } from '@angular/forms';
import { InputSwitchModule } from 'primeng/inputswitch';
import { DropdownModule } from 'primeng/dropdown';
import { ToastModule } from 'primeng/toast';
import { TopbarComponent } from './_components/topbar/topbar.component';
import { SidebarModule } from 'primeng/sidebar';
import { DividerModule } from 'primeng/divider';
import { MessagesModule } from 'primeng/messages';
import { MessageModule } from 'primeng/message';
import {BadgeModule} from 'primeng/badge';

@NgModule({
  declarations: [
    ConsoleComponent,
    HomeComponent,
    SidebarComponent,
    TopbarComponent,
    AdminComponent
  ],
  bootstrap: [
    ConsoleComponent
  ],
  imports: [
    CommonModule,
    ConsoleRoutingModule,
    ReactiveFormsModule,
    AccordionModule,
    CardModule,
    InputTextModule,
    RouterModule,
    StyleClassModule,
    ButtonModule,
    InputNumberModule,
    InputSwitchModule,
    DropdownModule,
    ToastModule,
    SidebarModule,
    DividerModule,
    MessagesModule,
    MessageModule,
    BadgeModule
  ],
  exports: [SidebarComponent, TopbarComponent]
})
export class ConsoleModule { }

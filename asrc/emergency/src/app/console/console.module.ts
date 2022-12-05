import { HomeComponent } from './home/home.component';
import { RouterModule } from '@angular/router';
import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { ConsoleRoutingModule } from './console-routing.module';
import { ConsoleComponent } from './console.component';
import { AccordionModule } from 'primeng/accordion';
import { CardModule } from 'primeng/card';
import { InputTextModule } from 'primeng/inputtext';
import {InputNumberModule} from 'primeng/inputnumber';
import { StyleClassModule } from 'primeng/styleclass';
import { ButtonModule } from 'primeng/button';
import { SidebarComponent } from '@app/_components/sidebar/sidebar.component';
import { ReactiveFormsModule } from '@angular/forms';
import {InputSwitchModule} from 'primeng/inputswitch';
import {DropdownModule} from 'primeng/dropdown';


@NgModule({
  declarations: [
    ConsoleComponent,
    HomeComponent,
    SidebarComponent
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
    DropdownModule
  ],
  exports:[SidebarComponent]
})
export class ConsoleModule { }

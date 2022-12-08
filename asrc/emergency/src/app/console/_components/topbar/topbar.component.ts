import { ConsoleComponent } from './../../console.component';
import { MessagesJs } from '@app/_modules/dtos/messagesjs';
import { Component, OnInit } from '@angular/core';
import { AccountService } from '@app/_modules/services';
import { MessageService } from 'primeng/api';

@Component({
  selector: 'app-topbar',
  templateUrl: './topbar.component.html',
  providers: [ConsoleComponent]
})
export class TopbarComponent implements OnInit {

  messages = [] as MessagesJs[];

  constructor(
    private accountService: AccountService,
    private messageService: MessageService
  ) { }

  checkBell(): void {
    this.accountService.loginChecks().subscribe({
      next: e => {
        this.messages = e
        e.forEach(element => {
          this.messageService.add({
            severity:element.error?"error":"success", 
            summary:element.error?'Error':'Saved', 
            detail:element.message?element.message:"Success!"
        });
        });
        
      }
    });
  }

  ngOnInit() {
    this.checkBell();
  }
}

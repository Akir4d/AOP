import { MessagesJs } from '../_modules/dtos/messagesjs';
import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { first } from 'rxjs/operators';

import { AccountService } from '@app/_modules/services';

@Component({ templateUrl: 'login.component.html' })
export class LoginComponent implements OnInit {
    form!: FormGroup;
    loading = false;
    submitted = false;
    messages!: MessagesJs[];

    constructor(
        private formBuilder: FormBuilder,
        private router: Router,
        private accountService: AccountService
    ) { }

    ngOnInit() {
        this.form = this.formBuilder.group({
            username: ['', Validators.required],
            password: ['', Validators.required]
        });
        this.accountService.loginChecks().subscribe({
            next: e=>{
                this.messages = e
            }
        });
    }

    // convenience getter for easy access to form fields
    get f() { return this.form.controls; }

    onSubmit() {
        this.submitted = true;

        // stop here if form is invalid
        if (this.form.invalid) {
            return;
        }

        this.loading = true;
        this.accountService.login(this.f.username.value, this.f.password.value)
            .pipe(first())
            .subscribe({
                next: () => {
                    // get return url from query parameters or default to home page
                    const returnUrl = `${document.getElementsByTagName("base")[0].href}`;
                    this.router.navigateByUrl(returnUrl);
                },
                error: error => {
                    this.loading = false;
                }
            });
    }
}
import React, {Component} from 'react';

import Axios from "axios";

export default class Login extends Component {

    render() {
        return(
            <div className="ss_taskManager text-center mt-5">
                <img src="images/logo.png" alt=""/>
            </div>
        );
    }

    componentDidMount() {
        Axios.get('/api/user').then(response => {
            console.log(response)
        }).catch(error => {
            console.log(error)
        });
    }

    constructor() {
        super();
        console.log(super())
    }

}

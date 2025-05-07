package com.example.agendaweb.Agenda;

import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RestController;
import org.springframework.web.bind.annotation.RequestMapping;

import lombok.RequiredArgsConstructor;

@RestController
@RequestMapping("/api/v1")
@RequiredArgsConstructor
public class AgendaController {

    @PostMapping (value = "demo")
    public String welcome() {
        return "Welcome from secure endpoint";
    }
}

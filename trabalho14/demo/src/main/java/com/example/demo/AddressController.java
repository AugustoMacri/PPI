package com.example.demo;

import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import java.util.ArrayList;
import java.util.Arrays;
import java.util.List;

@RestController
public class AddressController {

    private final List<Address> addresses = new ArrayList<>(
        Arrays.asList(
                new Address("38408100", "Floriano Peixoto", "Centro", "Uberlândia"),
                new Address("38408200", "Tiradentes", "Fundinho", "Uberlândia"),
                new Address("38408300", "Lions Clube", "Osvaldo Rezende", "Uberlândia")
        )
    );

    @GetMapping("/address") //Associar a requisicao GET utilizando o endereco addresses
    public List<Address> getAddresses(){
        return this.addresses;
    }

    @GetMapping("/address/{cep}")
    public ResponseEntity<Address> getAddress(@PathVariable String cep){
        for(Address address : this.addresses)
            if(address.getCep().equals(cep))
                return ResponseEntity.ok(address);

        return ResponseEntity.notFound().build();
    }

    @PostMapping("/address")
    public void addAddresses(@RequestBody Address address){
        this.addresses.add(address);
    }

    //Para remoção com o metodo delete
    @DeleteMapping("/address/{cep}")
    public ResponseEntity<Address> deleteAddress(@PathVariable String cep){
        for(Address address : this.addresses){
            if(address.getCep().equals(cep))
                this.addresses.remove(address);
                return ResponseEntity.ok(address);
        }

        return ResponseEntity.notFound().build();
    }

}

package com.juaachuc.todo_list.service;

import io.jsonwebtoken.Claims;
import io.jsonwebtoken.JwtException;
import io.jsonwebtoken.Jwts;
import io.jsonwebtoken.SignatureAlgorithm;
import io.jsonwebtoken.io.Decoders;
import io.jsonwebtoken.security.Keys;
import org.springframework.beans.factory.annotation.Value;
import org.springframework.stereotype.Service;

import javax.crypto.SecretKey;
import java.util.Date;
import java.util.Set;
import java.util.concurrent.ConcurrentHashMap;
import java.util.function.Function;

@Service
public class JwtService {
    @Value("${jwt.secret}")
    private String SECRET_KEY;

    @Value("${jwt.expiration}")
    private long jwtExpirationMs;

    private final Set<String> tokenBlacklist = ConcurrentHashMap.newKeySet();

    public String generarToken(String usuario) {
        return Jwts.builder()
                .setSubject(usuario)
                .setIssuedAt(new Date())
                .setExpiration(new Date(System.currentTimeMillis() + jwtExpirationMs))
                .signWith(getKey(), SignatureAlgorithm.HS256)
                .compact();
    }

    public SecretKey getKey() {
        byte[] keyBytes = Decoders.BASE64.decode(SECRET_KEY);
        return Keys.hmacShaKeyFor(keyBytes);
    }

    public boolean isTokenValid(String token) {
        return !tokenBlacklist.contains(token) &&
                !extractClaim(token, Claims::getExpiration).before(new Date());
    }

    public String extractUsername(String token) {
        return extractClaim(token, Claims::getSubject);
    }

    public void invalidateToken(String token) {
        tokenBlacklist.add(token);
    }

    private <T> T extractClaim(String token, Function<Claims, T> claimsResolver) {
        final Claims claims = extractAllClaims(token);
        return claimsResolver.apply(claims);
    }

    private Claims extractAllClaims(String token) {
        try {
            return Jwts.parser()  // <-- ¡Nuevo método en 0.12.x!
                    .verifyWith(getKey())  // Reemplaza setSigningKey()
                    .build()
                    .parseSignedClaims(token)  // Reemplaza parseClaimsJws()
                    .getPayload();  // Reemplaza getBody()
        } catch (JwtException e) {
            throw new JwtException("Token inválido: " + e.getMessage());
        }
    }
}